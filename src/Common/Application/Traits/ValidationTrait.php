<?php
declare(strict_types=1);

namespace Api\Common\Application\Traits;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

trait ValidationTrait
{
    public ?MessageBag $errors;

    /**
     * @param $data
     * @return bool
     */
    public function validate($data): bool
    {
        $validate = Validator::make($data, $this->rules);
        if ($validate->fails()) {
            $this->errors = $validate->errors();
            return false;
        }
        return true;


    }
}
