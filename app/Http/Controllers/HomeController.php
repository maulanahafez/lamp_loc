<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tailwindClasses = [
            'sWrapper' => 'dataTables_wrapper dt-tailwindcss',
            'sFilterInput' => 'border placeholder-gray-500 ml-2 px-3 py-2 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50',
            'sLengthSelect' => 'border px-3 py-2 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50',
            'sProcessing' => 'dt-processing uk-panel',
            'tailwindcss' => [
                'paging' => [
                    'active' => 'font-semibold bg-gray-100',
                    'notActive' => 'bg-white',
                    'button' => 'relative inline-flex justify-center items-center space-x-2 border px-4 py-2 -mr-px leading-6 hover:z-10 focus:z-10 active:z-10 border-gray-200 active:border-gray-200 active:shadow-none',
                    'first' => 'rounded-l-lg',
                    'last' => 'rounded-r-lg',
                    'enabled' => 'text-gray-800 hover:text-gray-900 hover:border-gray-300 hover:shadow-sm focus:ring focus:ring-gray-300 focus:ring-opacity-25',
                    'notEnabled' => 'text-gray-300',
                ],
                'table' => 'dataTable min-w-full text-sm align-middle whitespace-nowrap',
                'thead' => [
                    'row' => 'border-b border-gray-100',
                    'cell' => 'px-3 py-4 text-gray-900 bg-gray-100/75 font-semibold text-left',
                ],
                'tbody' => [
                    'row' => 'even:bg-gray-50',
                    'cell' => 'p-3',
                ],
                'tfoot' => [
                    'row' => 'even:bg-gray-50',
                    'cell' => 'p-3 text-left',
                ],
            ],
        ];

        print_r($tailwindClasses);

        return 'Hello';
    }
}
