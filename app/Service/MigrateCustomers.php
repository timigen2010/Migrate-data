<?php

namespace App\Service;

use App\Models\Customer\Service\Factory\CustomerFactoryAbstract;
use App\Models\Customer\Service\Factory\CustomerFactoryData;
use Illuminate\Support\Facades\Validator;

class MigrateCustomers implements MigrateCustomersInterface
{
    private CustomerFactoryAbstract $customerFactory;

    public function __construct(CustomerFactoryAbstract $customerFactory)
    {
        $this->customerFactory = $customerFactory;
    }

    public function migrate($filename, $firstRowHeader): array
    {

        $errors = [];

        try {
            $rows = new CsvIterator($filename);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

        foreach ($rows as $key=>$row){

            if(!$row['original'] || $firstRowHeader && $key == 1){
                continue;
            }

            $data = [
                'name' => !empty($row['data'][1]) ? (string)$row['data'][1] : "",
                'email' => !empty($row['data'][2]) ? (string)$row['data'][2] : "",
                'age' => !empty($row['data'][3]) && is_numeric($row['data'][3]) ? (int)$row['data'][3] : 0,
                'location' => !empty($row['data'][4]) && !is_numeric($row['data'][4]) ? (string)$row['data'][4] : 'Unknown',
            ];

            $validator = Validator::make($data, [
                'name' => 'required|string',
                'email' => 'required|email',
                'age' => 'required|integer|min:18|max:99',
            ]);

            if($validator->fails()){

                $errors []= ['error' => $validator->errors()->keys()[0], 'original' => $row['original']];

            } else {

                $customerFactoryData = new CustomerFactoryData($data['name'], $data['email'], $data['age'], $data['location']);
                $this->customerFactory->create($customerFactoryData);

            }
        }

        return $errors;
    }

}
