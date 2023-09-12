BEGIN
EXECUTE IMMEDIATE 'DROP TABLE Table_Date';
EXCEPTION
 WHEN OTHERS THEN
    IF SQLCODE != -942 THEN
    RAISE;
    END IF;
END;
/
BEGIN
EXECUTE IMMEDIATE 'DROP TABLE Lieu';
EXCEPTION
 WHEN OTHERS THEN
    IF SQLCODE != -942 THEN
    RAISE;
    END IF;
END;
/
BEGIN
EXECUTE IMMEDIATE 'DROP TABLE Appareil_photo';
EXCEPTION
 WHEN OTHERS THEN
    IF SQLCODE != -942 THEN
    RAISE;
    END IF;
END;
/
BEGIN
EXECUTE IMMEDIATE 'DROP TABLE Heritage_Photo';
EXCEPTION
 WHEN OTHERS THEN
    IF SQLCODE != -942 THEN
    RAISE;
    END IF;
END;
/
BEGIN
EXECUTE IMMEDIATE 'DROP TABLE Photo';
EXCEPTION
 WHEN OTHERS THEN
    IF SQLCODE != -942 THEN
    RAISE;
    END IF;
END;
/