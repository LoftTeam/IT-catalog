<?php

class ContactModel extends Model
{

    public function getManagers()
    {
        $sql = 'SELECT id,name,lastName,img,town,icq,tel FROM managers';

        $result = $this->DB->query($sql);

        $result = $result->fetchAll();
        return $result;
    }
}