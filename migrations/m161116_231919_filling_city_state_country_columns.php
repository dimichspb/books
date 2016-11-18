<?php

use yii\db\Migration;
use app\models\Reader;

class m161116_231919_filling_city_state_country_columns extends Migration
{
    public function up()
    {

        $statement =
<<<SQL
INSERT IGNORE INTO bx_city (Name)
SELECT 
  TRIM(SUBSTRING_INDEX(`Location`, ',', 1)) AS 'Name'
FROM `bx_users`;

INSERT IGNORE INTO bx_state (Name)
SELECT  
  CASE WHEN Location LIKE '%,%,%' THEN 
            TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(Location, ',', 2), ',', -1)) 
       WHEN Location LIKE '%,%' THEN 
            TRIM(SUBSTRING_INDEX(Location, ',', -1))
       ELSE NULL END AS 'Name'
FROM `bx_users`;

INSERT IGNORE INTO bx_country(Name)
SELECT  
  CASE WHEN Location LIKE '%,%,%' THEN
            TRIM(SUBSTRING_INDEX(Location, ',', -1))
       ELSE NULL END AS 'Name'
FROM `bx_users`;

INSERT INTO bx_user_location(User_ID, City_ID, State_ID, Country_ID)
SELECT 
  bx_users.User_ID,
  bx_city.City_ID,
  bx_state.State_ID,
  bx_country.Country_ID
FROM `bx_users`
  LEFT JOIN `bx_city` ON TRIM(SUBSTRING_INDEX(`bx_users`.`Location`, ',', 1)) = bx_city.Name
  LEFT JOIN `bx_state` ON 
    (CASE 
      WHEN Location LIKE '%,%,%' THEN 
        TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(Location, ',', 2), ',', -1)) 
      WHEN Location LIKE '%,%' THEN 
        TRIM(SUBSTRING_INDEX(Location, ',', -1))
      ELSE NULL END) = bx_state.Name
  LEFT JOIN `bx_country` ON
    (CASE 
      WHEN Location LIKE '%,%,%' THEN
        TRIM(SUBSTRING_INDEX(Location, ',', -1))
      ELSE NULL END) = bx_country.Name;
SQL;

        $this->db->createCommand($statement)->execute();


    }

    public function down()
    {
        \app\models\Location::deleteAll();
        \app\models\City::deleteAll();
        \app\models\State::deleteAll();
        \app\models\Country::deleteAll();
    }
    
}
