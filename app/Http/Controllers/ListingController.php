<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Upload;
use App\Imports\ListingImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Client;

class ListingController extends Controller
{
    public function import($id)
    {
        $upload = Upload::findOrFail($id);

        $filePath = storage_path('app/' . $upload->file);

        $listing = Listing::findOrFail($upload->listing_id);

        $columns = json_decode($listing->json, true);

        $import = new ListingImport();
        $data = Excel::toArray($import, $filePath);

        $processedData = [];
        foreach ($data[0] as $row) {
            $processedRow = [];
            foreach ($columns as $key => $column) {
                $processedRow[$column] = $row[$key] ?? null;
            }
            $processedData[] = $processedRow;
        }

        dd($processedData);
        die;

        $client = new Client();
        $response = $client->post('endpoint', [
            'json' => $processedData,
        ]);

        return response()->json([
            'message' => 'Importação e envio para Bitrix24 concluídos com sucesso!',
            'response' => json_decode($response->getBody(), true),
        ]);
    }
}