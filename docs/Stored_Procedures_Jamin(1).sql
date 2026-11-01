-- Stored Procedures voor database jamin
-- Project: Jamin - BE-opdracht 02

DELIMITER $$

DROP PROCEDURE IF EXISTS `sp_GetOverzichtLeveranciers`$$
CREATE PROCEDURE `sp_GetOverzichtLeveranciers`()
BEGIN
    SELECT
        l.Id,
        l.Naam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel,
        COUNT(DISTINCT ppl.ProductId) AS AantalVerschillendeProducten
    FROM leverancier l
    LEFT JOIN productperleverancier ppl
        ON l.Id = ppl.LeverancierId
    GROUP BY
        l.Id,
        l.Naam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel
    ORDER BY AantalVerschillendeProducten DESC;
END$$

DROP PROCEDURE IF EXISTS `sp_GetGeleverdeProducten`$$
CREATE PROCEDURE `sp_GetGeleverdeProducten`(IN `p_LeverancierId` INT)
BEGIN
    SELECT
        p.Id AS ProductId,
        p.Naam AS NaamProduct,
        COALESCE(m.AantalAanwezig, 0) AS AantalInMagazijn,
        m.VerpakkingsEenheid,
        MAX(ppl.DatumLevering) AS DatumLaatsteLevering
    FROM productperleverancier ppl
    INNER JOIN product p
        ON p.Id = ppl.ProductId
    LEFT JOIN magazijn m
        ON m.ProductId = p.Id
    WHERE ppl.LeverancierId = p_LeverancierId
    GROUP BY
        p.Id,
        p.Naam,
        m.AantalAanwezig,
        m.VerpakkingsEenheid
    ORDER BY AantalInMagazijn DESC;
END$$

DROP PROCEDURE IF EXISTS `sp_NieuweLevering`$$
CREATE PROCEDURE `sp_NieuweLevering`(
    IN `p_LeverancierId` INT,
    IN `p_ProductId` INT,
    IN `p_Aantal` INT,
    IN `p_Datum` DATE
)
BEGIN
    DECLARE v_IsActief BIT;
    DECLARE v_LeveringId INT;

    -- Controleer of het product actief is
    SELECT IsActief
    INTO v_IsActief
    FROM product
    WHERE Id = p_ProductId;

    IF v_IsActief = b'0' THEN
        SELECT 0 AS Succes;
    ELSE
        -- Zoek de laatste levering van deze leverancier en dit product
        SELECT Id
        INTO v_LeveringId
        FROM productperleverancier
        WHERE LeverancierId = p_LeverancierId
          AND ProductId = p_ProductId
        ORDER BY DatumLevering DESC, Id DESC
        LIMIT 1;

        -- Verhoog het aantal in het magazijn
        UPDATE magazijn
        SET AantalAanwezig = COALESCE(AantalAanwezig, 0) + p_Aantal,
            DatumGewijzigd = NOW(6)
        WHERE ProductId = p_ProductId;

        -- Werk alleen de laatste levering bij
        UPDATE productperleverancier
        SET Aantal = Aantal + p_Aantal,
            DatumLevering = p_Datum,
            DatumEerstVolgendeLevering = p_Datum,
            DatumGewijzigd = NOW(6)
        WHERE Id = v_LeveringId;

        SELECT 1 AS Succes;
    END IF;
END$$

DELIMITER ;
