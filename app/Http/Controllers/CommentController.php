<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentCollection;
use Google_Client;
use Google_Service_Sheets;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(5);
        return new CommentCollection($comments);
    }

    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    public function export(Request $request)
    {
        // Obtener los comentarios basados en el rango de fechas
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Lógica para obtener los comentarios según el rango de fechas
        $comments = Comment::whereBetween('created_at', [$startDate, $endDate])->get();

        // Configurar el cliente de Google Sheets
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('path-to-your-credentials-file.json'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS);

        // Crear una instancia del servicio Google Sheets
        $service = new Google_Service_Sheets($client);

        // ID del spreadsheet de Google Sheets
        $spreadsheetId = 'your-spreadsheet-id';

        // Nombre de la hoja de cálculo
        $sheetName = 'Sheet1';

        // Formatear los datos para la hoja de cálculo
        $values = [];
        foreach ($comments as $comment) {
            $values[] = [$comment->id, $comment->body, $comment->created_at];
        }

        // Rango de celdas para escribir los datos
        $range = $sheetName;

        // Crear una solicitud para escribir los datos en la hoja de cálculo
        $requestBody = new Google_Service_Sheets_ValueRange([
            'values' => $values,
        ]);

        // Enviar la solicitud para escribir los datos en la hoja de cálculo
        $response = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, [
            'valueInputOption' => 'USER_ENTERED',
        ]);

        // Puedes manejar la respuesta aquí

        return response()->json(['message' => 'Datos exportados a Google Sheets']);
    }
}
