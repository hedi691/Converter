

# Currency converter


## How to use the converter?
	1. Execute the sql script "converter.sql" to create the table
	2. Change the database inforamtion in "ExchangeRatePersistence.php"
	3. Populate manually the exchange rates into the table:  php populate_currency_rate.php
	4. Launch the script "convert.php"
		Exemple:
			1. php convert.php "JPY 100"
			2. php convert.php "JPY 10" "BGN 50" "ARS 32"
		
		
## What need to be done?
	1. Store the MySQL informations properly because they are now stored in "ExchangeRatePersistence.php" as constant
	1. Handle correctly the wrong inputs
	1. Check the value returned by SQL queries