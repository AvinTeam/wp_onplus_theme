<?php

use oniclass\ARMADB;

class ARMAVISIT extends ARMADB
{

    public function __construct($table)
    {
        parent::__construct($table); // مقدار $name را به والد می‌فرستیم
    }

    public function getall()
    {
        $result = $this->wpdb->get_results(
            "SELECT
                visit_date,
                cunt_visiter
            FROM (
                SELECT
                    DATE(created_at) AS visit_date,
                    COUNT(DISTINCT visiter) AS cunt_visiter
                FROM `$this->tablename`
                GROUP BY DATE(created_at)
                ORDER BY visit_date DESC
                LIMIT 10
            ) AS subquery
            ORDER BY visit_date ASC;");

        return $result;

    }

}