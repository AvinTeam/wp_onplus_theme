<?php

use oniclass\ARMADB;

class ARMAVISIT extends ARMADB
{
    private $result = [  ];

    public function __construct($table)
    {
        parent::__construct($table); // مقدار $name را به والد می‌فرستیم
    }

    public function getall()
    {
        $this->result = $this->wpdb->get_results(
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
                LIMIT 7
            ) AS subquery
            ORDER BY visit_date ASC;");

        return $this;

    }

    public function get_by_date(string $from_date = '', string $to_date = '')
    {
        $where = "";
        if (empty($to_date)) {
            $to_date = date('Y-m-d');
        }

        if (empty($from_date)) {
            $where = "WHERE created_at <= '$to_date 23:59:59'";
        }

        if (! empty($from_date)) {
            $where = "WHERE created_at BETWEEN '$from_date 00:00:00'  AND '$to_date 23:59:59'";
        }

        $this->result = $this->wpdb->get_results(
            "SELECT
                DATE(created_at) AS visit_date,
                COUNT(DISTINCT visiter) AS cunt_visiter
            FROM `$this->tablename`
            $where
            GROUP BY DATE(created_at)
            ORDER BY visit_date ASC
        ");

        return $this;

    }

    public function show(): array
    {
        $date_array  = [  ];
        $count_array = [  ];

        foreach ($this->result as $v) {
            $date_array[  ]  = tarikh($v->visit_date);
            $count_array[  ] = $v->cunt_visiter;
        }

        return [
            'date'  => $date_array,
            'count' => $count_array,
         ];
    }

}
