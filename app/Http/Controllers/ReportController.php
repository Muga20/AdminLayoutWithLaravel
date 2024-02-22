<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use App\Models\Property;
use App\Models\Apartment;


class ReportController extends Controller
{
    /**
     * Download the monthly report.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadMonthlyReport()
    {
        // Get current month and year
        $currentMonth = now()->format('F');
        $currentYear = now()->format('Y');

        // Get properties for the current month
        $properties = Property::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', now()->month)
            ->get();

        // Generate CSV content
        $csv = Writer::createFromString('');
        $csv->insertOne(['Name', 'Selling Price', 'Description', 'Location', 'Category']);

        foreach ($properties as $property) {

            $description = strip_tags($property->description);

            $csv->insertOne([
                $property->name,
                $property->selling_price,
                $description,
                $property->location,
                $property->category->name
            ]);
        }

        // Download the CSV file
        return response($csv->getContent(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="monthly_report_' . $currentMonth . '.csv"',
        ]);
    }

    /**
     * Download the yearly report.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadYearlyReport()
    {
        // Get current year
        $currentYear = now()->format('Y');

        // Get properties for the current year
        $properties = Property::whereYear('created_at', $currentYear)
            ->get();

        // Generate CSV content
        $csv = Writer::createFromString('');
        $csv->insertOne(['Name', 'Selling Price', 'Description', 'Location', 'Category']);

        foreach ($properties as $property) {

            $description = strip_tags($property->description);

            $csv->insertOne([
                $property->name,
                $property->selling_price,
                $description,
                $property->location,
                $property->category->name
            ]);
        }

        // Download the CSV file
        return response($csv->getContent(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="yearly_report_' . $currentYear . '.csv"',
        ]);
    }



       // Existing methods...

    /**
     * Download the monthly report for apartments.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadMonthlyApartmentReport()
    {
        // Get current month and year
        $currentMonth = now()->format('F');
        $currentYear = now()->format('Y');

        // Get apartments for the current month
        $apartments = Apartment::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', now()->month)
            ->get();

        // Generate CSV content
        $csv = Writer::createFromString('');
        $csv->insertOne(['Name', 'Rent', 'Description', 'Location', 'Number of Bedrooms', 'All Rooms', 'Number of Kitchen', 'Number of Bathrooms', 'Category']);

        foreach ($apartments as $apartment) {
            $description = strip_tags($apartment->description);

            $csv->insertOne([
                $apartment->name,
                $apartment->selling_price,
                $description,
                $apartment->location,
                $apartment->number_of_bedrooms,
                $apartment->all_rooms,
                $apartment->number_of_kitchen,
                $apartment->number_of_bathrooms,
                $apartment->category->name,

            ]);
        }

        // Download the CSV file
        return response($csv->getContent(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="monthly_apartment_report_' . $currentMonth . '.csv"',
        ]);
    }

    /**
     * Download the yearly report for apartments.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadYearlyApartmentReport()
    {
        // Get current year
        $currentYear = now()->format('Y');

        // Get apartments for the current year
        $apartments = Apartment::whereYear('created_at', $currentYear)
            ->get();

        // Generate CSV content
        $csv = Writer::createFromString('');
        $csv->insertOne(['Name', 'Rent', 'Description', 'Location', 'Number of Bedrooms', 'All Rooms', 'Number of Kitchen', 'Number of Bathrooms', 'Category']);

        foreach ($apartments as $apartment) {
            $description = strip_tags($apartment->description);


            $csv->insertOne([
                $apartment->name,
                $apartment->selling_price,
                $description,
                $apartment->location,
                $apartment->number_of_bedrooms,
                $apartment->all_rooms,
                $apartment->number_of_kitchen,
                $apartment->number_of_bathrooms,
                $apartment->category->name,
                $amenities,
            ]);
        }

        // Download the CSV file
        return response($csv->getContent(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="yearly_apartment_report_' . $currentYear . '.csv"',
        ]);
    }
}
