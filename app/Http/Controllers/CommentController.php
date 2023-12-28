<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
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

    public function store(CommentStoreRequest $request)
    {
        return new CommentResource(Comment::create($request->all()));
    }

    public function destroy($id)
    {
        Comment::where('id', $id)->delete();
        return response()->json(['message' => 'mensaje eliminado']);
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $comments = Comment::whereBetween('created_at', [$startDate, $endDate])->get();

        $client = new Google_Client();
        $client->setAuthConfig(storage_path('path-to-your-credentials-file.json'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS);

        $service = new Google_Service_Sheets($client);

        $spreadsheetId = 'your-spreadsheet-id';

        $sheetName = 'Sheet1';

        $values = [];
        foreach ($comments as $comment) {
            $values[] = [$comment->id, $comment->body, $comment->created_at];
        }

        $range = $sheetName;

        $requestBody = new Google_Service_Sheets_ValueRange([
            'values' => $values,
        ]);

        $response = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, [
            'valueInputOption' => 'USER_ENTERED',
        ]);

        return response()->json(['message' => 'Datos exportados a Google Sheets']);
    }
}
