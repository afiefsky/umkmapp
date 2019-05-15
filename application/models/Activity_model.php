<?php

class Activity_model extends CI_Model
{
    public function list($user_id)
    {
        $query = "SELECT act.*
                    FROM companies AS com
                    RIGHT JOIN activities AS act
                        ON act.company_id = com.id
                    INNER JOIN users_companies AS usc
                        ON usc.company_id = com.id
                    WHERE usc.user_id = $user_id";

        return $this->db->query($query);
    }
}
