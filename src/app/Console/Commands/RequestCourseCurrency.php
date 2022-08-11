<?php

namespace App\Console\Commands;

use App\Models\ChangeCourse;
use App\Models\Currency;
use App\Models\RequestCBR;
use App\Service\RequestData;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RequestCourseCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command that allows you to get data on exchange rates, as well as implement an update scheduler';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cache = (new RequestCBR)->getArrayCurrent();
        $valutesCB = (new RequestData);

        foreach ($valutesCB->valutes as $valute) {
            if(in_array($valute['Valute'], $cache)){
                DB::beginTransaction();
                try {
                    $change = false;
                    $valuteFloat = str_replace(',', '.', $valute['Value']);
                    if($currency = Currency::where('valute_id', $valute['Valute'])->first()) {
                        $currencyId = $currency->id;
                        $valuteFloat > (new ChangeCourse)->getCourseLastModel($currencyId) ? $change = true : $change= false;
                    }
                    else {
                        $result = Currency::create([
                            'valute_id' => $valute['Valute'],
                            'num_code' => $valute['NumCode'],
                            'char_code' => $valute['CharCode'],
                            'nominal' => $valute['Nominal'],
                            'name' => $valute['Name'],
                            'view' => false
                        ]);

                        if(!isset($result->id)) {
                            DB::rollBack();
                            throw new Exception("No currency record has been created");
                        }

                        $currencyId = $result->id;
                    }

                    $result = ChangeCourse::create([
                        'date' => strtotime($valutesCB->dateUpdate),
                        'value' => (float) $valuteFloat,
                        'currency_id' => $currencyId,
                        'change' => $change
                    ]);

                    if(!isset($result->id)) {
                        DB::rollBack();
                        throw new Exception("A course change record has not been created");
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw $th;
                }

                DB::commit();
            }
        }
        $this->info('success');
    }
}
