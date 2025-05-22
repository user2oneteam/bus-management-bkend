<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Adjust if needed

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function bmp_export_trip_excel() {
    global $wpdb;

    $rows = $wpdb->get_results("
        SELECT 
            d.id AS trip_id,
            b.bus_number,
            c.name AS company,
            lf.name AS from_location,
            lt.name AS to_location,
            d.departure_time,
            a.arrival_time,
            s.name AS status,
            d.passengers
        FROM {$wpdb->prefix}bmp_departures d
        JOIN {$wpdb->prefix}bmp_buses b ON d.bus_id = b.id
        JOIN {$wpdb->prefix}bmp_companies c ON b.company_id = c.id
        JOIN {$wpdb->prefix}bmp_locations lf ON d.from_location_id = lf.id
        JOIN {$wpdb->prefix}bmp_locations lt ON d.to_location_id = lt.id
        LEFT JOIN {$wpdb->prefix}bmp_arrivals a ON a.bus_id = b.id
        JOIN {$wpdb->prefix}bmp_statuses s ON b.status_id = s.id
    ", ARRAY_A);

    if (empty($rows)) {
        wp_die('No data to export.');
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add headers
    $sheet->fromArray(array_keys($rows[0]), null, 'A1');

    // Add data
    $sheet->fromArray($rows, null, 'A2');

    // Output to browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="bus_trip_export.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
