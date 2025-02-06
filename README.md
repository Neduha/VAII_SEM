Inštalačný návod pre webovú aplikáciu

Táto aplikácia beží na Laravel frameworku 

1. Systémové požiadavky

PHP vo verzii 8.1 alebo novšej
Composer ako správcu PHP balíčkov
Podporovanú databázu čiže SQLite


2. Klonovanie projektu
	Najprv si stiahnite projekt z repozitára pomocou príkazu git clone, pričom nahradíte URL adresou repozitára. Potom prejdite do adresára projektu pomocou príkazu cd a názvu adresára.

3. Inštalácia závislostí
	Pre inštaláciu všetkých potrebných PHP balíčkov použite Composer

4. Nastavenie prostredia
	Je potrebné skopírovať konfiguračný súbor .env.example a premenovať ho na .env. Potom ho otvorte a nastavte potrebné hodnoty.

5. Generovanie aplikačného kľúča
	Na zabezpečenie aplikácie je potrebné vygenerovať unikátny aplikačný kľúč pomocou príkazu Artisan.

6. Migrácia databázy
	V databáze je potrebné vytvoriť tabuľky pomocou migrácií.

7. Spustenie servera
	Na spustenie aplikácie je potrebné spustiť lokálny Laravel server. Po jeho spustení bude aplikácia dostupná na adrese localhost s predvoleným portom 8000.


