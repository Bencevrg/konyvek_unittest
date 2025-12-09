<?php

namespace App\Http\Controllers;

use App\Http\Requests\WriterRequest;
use App\Models\WriterModel;

class WriterController extends Controller
{
    /**
     * @api {get} /writers Lista lekérése
     * @apiName GetWriters
     * @apiGroup Writers
     * @apiVersion 1.0.0
     * @apiDescription Visszaadja az összes író rekordot JSON formátumban.
     * 
     * @apiSuccess {Object[]} writers Az írók listája.
     * @apiSuccess {Number} writers.id Az író azonosítója.
     * @apiSuccess {String} writers.name Az író neve.
     * @apiSuccess {String} writers.bio Az író rövid bemutatása.
     * @apiSuccess {String} [writers.portrait_path] Az író képének elérési útja (ha van).
     * @apiSuccess {String} writers.created_at Létrehozás dátuma.
     * @apiSuccess {String} writers.updated_at Utolsó módosítás dátuma.
     * 
     * @apiSuccessExample {json} Sikeres válasz:
     * HTTP/1.1 200 OK
     * {
     *   "writers": [
     *     {
     *       "id": 1,
     *       "name": "Vki",
     *       "bio": "Vmi",
     *       "portrait_path": "vki.jpg",
     *       "created_at": "2025-11-12T12:00:00Z",
     *       "updated_at": "2025-11-12T12:00:00Z"
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $writers = WriterModel::all();
        return response()->json(['writers' => $writers]);
    }

    public function create()
    {
        return view('writers.create');
    }

    /**
     * @api {post} /writers Új író létrehozása
     * @apiName CreateWriter
     * @apiGroup Writers
     * @apiVersion 1.0.0
     * @apiDescription Létrehoz egy új írót a megadott adatok alapján.
     * 
     * @apiBody {String} name Az író neve.
     * @apiBody {String} bio Az író rövid bemutatása.
     * @apiBody {File} [portrait] Portrékép feltöltése (opcionális).
     * 
     * @apiSuccess {Object} writer A létrehozott író objektuma.
     * @apiSuccess {Number} writer.id Az író azonosítója.
     * @apiSuccess {String} writer.name Az író neve.
     * @apiSuccess {String} writer.bio Az író bemutatása.
     * @apiSuccess {String} [writer.portrait_path] A portrékép elérési útja.
     * @apiSuccess {String} writer.created_at Létrehozás dátuma.
     * @apiSuccess {String} writer.updated_at Utolsó módosítás dátuma.
     * 
     * @apiSuccessExample {json} Sikeres válasz:
     * HTTP/1.1 201 Created
     * {
     *   "writer": {
     *     "id": 2,
     *     "name": "George Orwell",
     *     "bio": "1984 és Állatfarm szerzője.",
     *     "portrait_path": "writers/orwell.png",
     *     "created_at": "2025-10-21T10:30:00Z",
     *     "updated_at": "2025-10-21T10:30:00Z"
     *   }
     * }
     */
    public function store(WriterRequest $request)
    {
        $portraitPath = null;
        if ($request->hasFile('portrait')) {
            $portraitPath = $request->file('portrait')->store('writers', 'public');
        }

        $writer = WriterModel::create($request->all());

        return response()->json(['writer' => $writer]);
        //return redirect()->back()->with('success', 'Author created!');
    }

    /**
     * @api {get} /writers/:id Egy író lekérése
     * @apiName GetWriter
     * @apiGroup Writers
     * @apiVersion 1.0.0
     * @apiDescription Visszaadja a megadott azonosítójú írót.
     * 
     * @apiParam {Number} id Az író azonosítója.
     * 
     * @apiSuccess {Object} writer Az író adatai.
     * @apiSuccess {Number} writer.id Az író azonosítója.
     * @apiSuccess {String} writer.name Az író neve.
     * @apiSuccess {String} writer.bio Az író rövid bemutatása.
     * @apiSuccess {String} [writer.portrait_path] Portrékép elérési útja.
     * @apiSuccess {String} writer.created_at Létrehozás dátuma.
     * @apiSuccess {String} writer.updated_at Utolsó módosítás dátuma.
     */
    public function show(string $id)
    {
        $writers = WriterModel::find($id);
        return view('writers.show', compact('writers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $writers = WriterModel::find($id);
        return view('writers.edit', compact('writers'));
    }

    /**
     * @api {put} /writers/:id Író módosítása
     * @apiName UpdateWriter
     * @apiGroup Writers
     * @apiVersion 1.0.0
     * @apiDescription Frissíti a megadott író adatait.
     * 
     * @apiParam {Number} id Az író azonosítója.
     * 
     * @apiBody {String} [name] Az író neve.
     * @apiBody {String} [bio] Az író rövid bemutatása.
     * @apiBody {File} [portrait] Portrékép feltöltése (opcionális).
     * 
     * @apiSuccess {Object} writer A frissített író objektuma.
     * @apiSuccessExample {json} Sikeres válasz:
     * HTTP/1.1 200 OK
     * {
     *   "writer": {
     *     "id": 2,
     *     "name": "George Orwell",
     *     "bio": "Brit író és újságíró.",
     *     "portrait_path": "writers/orwell_updated.png",
     *     "updated_at": "2025-10-21T11:00:00Z"
     *   }
     * }
     */
    public function update(WriterRequest $request, string $id)
    {
        $writer = WriterModel::find($id);
        if (!$writer) {
        return response()->json(['message' => 'Not found!'], 404);
        }

        $writer->update($request->all());

        return response()->json($writer, 200);
    }

    /**
     * @api {delete} /writers/:id Író törlése
     * @apiName DeleteWriter
     * @apiGroup Writers
     * @apiVersion 1.0.0
     * @apiDescription Törli a megadott írót az adatbázisból.
     * 
     * @apiParam {Number} id Az író azonosítója.
     * 
     * @apiSuccess {String} message Törlés státuszüzenete.
     * @apiSuccess {Number} id A törölt író azonosítója.
     * 
     * @apiSuccessExample {json} Sikeres válasz:
     * HTTP/1.1 200 OK
     * {
     *   "message": "Deleted successfully.",
     *   "id": 2
     * }
     */
public function destroy(string $id)
{
    $writer = WriterModel::find($id);

    if (!$writer) {
        return response()->json(['message' => 'Not found!'], 404);
    }

    $writer->delete();

    return response()->json(['message' => 'Deleted'], 410);
}

}
