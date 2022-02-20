<?php


namespace App\Traits;

/**
 * Trait SoftDelete
 * @package App\Traits
 */
trait SoftDelete
{

    public function delete()
    {
        $this->deleted_at = now();
        $this->save();
    }
}
