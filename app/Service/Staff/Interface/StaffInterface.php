<?php

namespace App\Service\Staff\Interface;

interface StaffInterface
{
    public function allStaff();
    public function getStaff($staff_id);
    public function add($data);
    public function update($staff_id);
    public function delete($staff_id);
}