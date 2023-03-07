<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interfaces InvoiceRepository.
 */
interface InvoiceInterfaces
{
    public function createInvoice(object $invoiceRequestData): ?Response;
    public function editInvoice(string $invoiceId, object $invoiceRequestData): ?Response;
    public function showInvoice(string $invoiceId): ?Response;
    public function destroyInvoice(string $invoiceId): ?Response;
    public function setInvoicePaid(string $invoiceId): ?Response;
    public function getInvoices(): ?Response;
}
/**
 * Class InvoiceRepository.
 */
class InvoiceRepository implements InvoiceInterfaces
{

    /*
    * This method creates a new invoice record
    * @param invoiceRequestData
    * @return Response
    */
    public function createInvoice(object $invoiceRequestData): ?Response
    {
        DB::beginTransaction();
        try {
            $invoice = new Invoice;
            $invoice->address_from = $invoiceRequestData->formData["address_from"];
            $invoice->city_from = $invoiceRequestData->formData["city_from"];
            $invoice->post_code_from = $invoiceRequestData->formData["post_code_from"];
            $invoice->country_from = $invoiceRequestData->formData["country_from"];
            $invoice->client_name = $invoiceRequestData->formData["client_name"];
            $invoice->client_email = $invoiceRequestData->formData["client_email"];
            $invoice->address_to = $invoiceRequestData->formData["address_to"];
            $invoice->city_to = $invoiceRequestData->formData["city_to"];
            $invoice->post_code_to = $invoiceRequestData->formData["post_code_to"];
            $invoice->country_to = $invoiceRequestData->formData["country_to"];
            $invoice->invoice_date = $invoiceRequestData->formData["invoice_date"];
            $invoice->payment_terms = $invoiceRequestData->selectedOption;
            $invoice->project_description = $invoiceRequestData->formData["project_description"];
            $invoice->status = "pending";
            $invoice->items = $invoiceRequestData->items;
            $invoice->key = self::createRandomInvoiceKey();

            $invoice->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Invoice created successfully',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /*
    * This method fetches a specific invoice record
    * @param invoiceId, invoiceRequestData
    * @return Response
    */
    public function editInvoice($invoiceId, $invoiceRequestData): ?Response
    {
        DB::beginTransaction();
        try {

            $invoice = Invoice::find($invoiceId);

            if ($invoice) {
                $invoice->address_from = $invoiceRequestData->formData["address_from"];
                $invoice->city_from = $invoiceRequestData->formData["city_from"];
                $invoice->post_code_from = $invoiceRequestData->formData["post_code_from"];
                $invoice->country_from = $invoiceRequestData->formData["country_from"];
                $invoice->client_name = $invoiceRequestData->formData["client_name"];
                $invoice->client_email = $invoiceRequestData->formData["client_email"];
                $invoice->address_to = $invoiceRequestData->formData["address_to"];
                $invoice->city_to = $invoiceRequestData->formData["city_to"];
                $invoice->post_code_to = $invoiceRequestData->formData["post_code_to"];
                $invoice->country_to = $invoiceRequestData->formData["country_to"];
                $invoice->invoice_date = $invoiceRequestData->formData["invoice_date"];
                $invoice->payment_terms = $invoiceRequestData->selectedOption;
                $invoice->project_description = $invoiceRequestData->formData["project_description"];
                $invoice->items = $invoiceRequestData->items;
                $invoice->save();
                DB::commit();
            }

            return response()->json([
                'status' => true,
                'message' => 'Invoice updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /*
    * This method get all invoice records
    * @return Response
    */
    public function getInvoices(): ?Response
    {
        try {
            $invoices = Invoice::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => true,
                'message' => 'Invoices Get Successfully',
                'data' => $invoices,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /*
    * This method brings up the invoice record
    * @param invoiceId
    * @return Response
    */
    public function showInvoice($invoiceId): ?Response
    {
        try {
            $invoices = Invoice::whereId($invoiceId)->first();
            return response()->json([
                'status' => true,
                'message' => 'Invoics Get Successfully',
                'data' => $invoices,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /*
    * This method destroy the invoice record
    * @param invoiceId
    * @return Response
    */
    public function destroyInvoice($invoiceId): ?Response
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::whereId($invoiceId)->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Invoice Destroy Successfully',
                'data' => $invoice,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /*
    * This method updates the invoice record
    * @param invoiceId
    * @return Response
    */
    public function setInvoicePaid($invoiceId): ?Response
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::whereId($invoiceId)->update(["status" => "paid"]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Set Invoice Paid Successfully',
                'data' => $invoice,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /*
    * This method generates random key
    * @return key
    */
    private function createRandomInvoiceKey()
    {
        $keyFormat = "XX######";
        $key = str_replace("X", chr(rand(65, 90)), $keyFormat);
        $key = str_replace("#", rand(0, 9), $key);
        return $key;
    }
}
