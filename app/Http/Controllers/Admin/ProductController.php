<?php

// app/Http/Controllers/Admin/ProductController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Search;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Search::orderByDesc('id')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function show(Search $search)
    {
        // Devuelve JSON para precargar el modal
        return response()->json($search);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo'        => 'nullable|integer',
            'name'        => 'required|string|max:110',
            'volumen'     => 'nullable|numeric',
            'codigo'      => 'nullable|string|max:50',
            'stock'       => 'nullable|string|max:7',
            'categoria'   => 'nullable|string|max:35',
            'image'       => 'nullable|string|max:118',
            'thumb'       => 'nullable|string|max:112',
            'precio'      => 'nullable|numeric',
            'costo'       => 'nullable|numeric',
            'preciof'     => 'nullable|numeric',
            'description' => 'nullable|string|max:1500',
            'caracteristicas_raw' => 'nullable|string|max:4000',
            'puntos'      => 'nullable|string|max:6',
            'image1'      => 'nullable|string|max:50',
            'image2'      => 'nullable|string|max:50',
            'image3'      => 'nullable|string|max:50',
            'impropio'    => 'nullable|boolean',
            'soli'        => 'nullable|boolean',
            'fecha'       => 'nullable|string|max:50',
            'preventa'    => 'nullable|numeric',
            'preventab'   => 'nullable|boolean',
            'oferta'      => 'nullable|boolean',
            'car2'        => 'array',
            'esp'         => 'array',
            
            'image_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'thumb_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image1_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image2_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image3_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

        ]);

        // Normalizaciones
        $caracteristicas = null;
        if ($request->filled('caracteristicas_raw')) {
            $items = preg_split('/[\r\n,]+/', $request->input('caracteristicas_raw'));
            $items = array_filter(array_map('trim', $items), fn($v) => $v !== '');
            $caracteristicas = implode(' | ', array_slice($items, 0, 400));
        }

        $car2 = array_values(array_filter(
            $request->input('car2', []),
            fn($i) => (trim($i['titulo'] ?? '') !== '') || (trim($i['valor'] ?? '') !== '')
        ));

        $esp = array_values(array_filter(
            $request->input('esp', []),
            fn($i) => (trim($i['imagen'] ?? '') !== '') || (trim($i['titulo'] ?? '') !== '') || (trim($i['valor'] ?? '') !== '')
        ));
        $imageName = $request->input('image');
        if ($request->hasFile('image_file')) {
            $imageName = $this->saveImageFile($request->file('image_file'));
        }

        $thumbName = $request->input('thumb');
        if ($request->hasFile('thumb_file')) {
            $thumbName = $this->saveImageFile($request->file('thumb_file'));
        }
        
        $image1Name = $request->input('image1');
        if ($request->hasFile('image1_file')) {
            $image1Name = $this->saveImageFile($request->file('image1_file'));
        }

        $image2Name = $request->input('image2');
        if ($request->hasFile('image2_file')) {
            $image2Name = $this->saveImageFile($request->file('image2_file'));
        }

        $image3Name = $request->input('image3');
        if ($request->hasFile('image3_file')) {
            $image3Name = $this->saveImageFile($request->file('image3_file'));
        }

        $product = Search::create([
            'tipo'            => $request->input('tipo'),
            'name'            => $request->input('name'),
            'volumen'         => $request->input('volumen'),
            'codigo'          => $request->input('codigo'),
            'stock'           => $request->input('stock'),
            'categoria'       => $request->input('categoria'),

            'image'           => $imageName,

            'thumb'           => $thumbName,

            'precio'          => $request->input('precio'),
            'costo'           => $request->input('costo'),
            'preciof'         => $request->input('preciof'),
            'description'     => $request->input('description'),
            'caracteristicas' => $caracteristicas,
            'caracteristicas2'=> $car2,
            'especificaciones'=> $esp,
            'puntos'          => $request->input('puntos'),
            'image1'          => $request->input('image1'),
            'image2'          => $request->input('image2'),
            'image3'          => $request->input('image3'),
            'impropio'        => $request->boolean('impropio'),
            'soli'            => $request->boolean('soli'),
            'fecha'           => $request->input('fecha'),
            'preventa'        => $request->input('preventa'),
            'preventab'       => $request->boolean('preventab'),
            'oferta'          => $request->boolean('oferta'),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['ok'=>true, 'item'=>$product], 201);
        }
        return redirect()->route('admin.products.index')->with('status','Creado');
    }

    public function update(Request $request, Search $search)
    {
        $validated = $request->validate([
            'tipo'        => 'nullable|integer',
            'name'        => 'required|string|max:110',
            'volumen'     => 'nullable|numeric',
            'codigo'      => 'nullable|string|max:50',
            'stock'       => 'nullable|string|max:7',
            'categoria'   => 'nullable|string|max:35',
            'image_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'thumb_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'precio'      => 'nullable|numeric',
            'costo'       => 'nullable|numeric',
            'preciof'     => 'nullable|numeric',
            'description' => 'nullable|string|max:1500',
            'caracteristicas_raw' => 'nullable|string|max:4000',
            'puntos'      => 'nullable|string|max:6',
            'image1_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image2_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image3_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'impropio'    => 'nullable|boolean',
            'soli'        => 'nullable|boolean',
            'fecha'       => 'nullable|string|max:50',
            'preventa'    => 'nullable|numeric',
            'preventab'   => 'nullable|boolean',
            'oferta'      => 'nullable|boolean',
            'car2'        => 'array',
            'esp'         => 'array',

             'image_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'thumb_file'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $caracteristicas = null;
        if ($request->filled('caracteristicas_raw')) {
            $items = preg_split('/[\r\n,]+/', $request->input('caracteristicas_raw'));
            $items = array_filter(array_map('trim', $items), fn($v) => $v !== '');
            $caracteristicas = implode(' | ', array_slice($items, 0, 400));
        }

        $car2 = array_values(array_filter(
            $request->input('car2', []),
            fn($i) => (trim($i['titulo'] ?? '') !== '') || (trim($i['valor'] ?? '') !== '')
        ));

        $esp = array_values(array_filter(
            $request->input('esp', []),
            fn($i) => (trim($i['imagen'] ?? '') !== '') || (trim($i['titulo'] ?? '') !== '') || (trim($i['valor'] ?? '') !== '')
        ));
                // Imagen principal
        $imageName = $request->input('image', $search->image);
        if ($request->hasFile('image_file')) {
            // Opcional: borrar archivo viejo
            if ($search->image && file_exists(public_path('image/productos/'.$search->image))) {
                @unlink(public_path('image/productos/'.$search->image));
            }
            $imageName = $this->saveImageFile($request->file('image_file'));
        }

        // Thumb
        $thumbName = $request->input('thumb', $search->thumb);
        if ($request->hasFile('thumb_file')) {
            if ($search->thumb && file_exists(public_path('image/productos/'.$search->thumb))) {
                @unlink(public_path('image/productos/'.$search->thumb));
            }
            $thumbName = $this->saveImageFile($request->file('thumb_file'));
        }
        
        $image1Name = $request->input('image1', $search->image1);
        if ($request->hasFile('image1_file')) {
            if ($search->image1 && file_exists(public_path('image/productos/'.$search->image1))) {
                @unlink(public_path('image/productos/'.$search->image1));
            }
            $image1Name = $this->saveImageFile($request->file('image1_file'));
        }

        $image2Name = $request->input('image2', $search->image2);
        if ($request->hasFile('image2_file')) {
            if ($search->image2 && file_exists(public_path('image/productos/'.$search->image2))) {
                @unlink(public_path('image/productos/'.$search->image2));
            }
            $image2Name = $this->saveImageFile($request->file('image2_file'));
        }

        $image3Name = $request->input('image3', $search->image3);
        if ($request->hasFile('image3_file')) {
            if ($search->image3 && file_exists(public_path('image/productos/'.$search->image3))) {
                @unlink(public_path('image/productos/'.$search->image3));
            }
            $image3Name = $this->saveImageFile($request->file('image3_file'));
        }

        $search->update([
            'tipo'            => $request->input('tipo'),
            'name'            => $request->input('name'),
            'volumen'         => $request->input('volumen'),
            'codigo'          => $request->input('codigo'),
            'stock'           => $request->input('stock'),
            'categoria'       => $request->input('categoria'),
            'image'           => $imageName,
            'thumb'           => $thumbName,
            'precio'          => $request->input('precio'),
            'costo'           => $request->input('costo'),
            'preciof'         => $request->input('preciof'),
            'description'     => $request->input('description'),
            'caracteristicas' => $caracteristicas,
            'caracteristicas2'=> $car2,
            'especificaciones'=> $esp,
            'puntos'          => $request->input('puntos'),
            'image1'          => $image1Name,
            'image2'          => $image2Name,
            'image3'          => $image3Name,
            'impropio'        => $request->boolean('impropio'),
            'soli'            => $request->boolean('soli'),
            'fecha'           => $request->input('fecha'),
            'preventa'        => $request->input('preventa'),
            'preventab'       => $request->boolean('preventab'),
            'oferta'          => $request->boolean('oferta'),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['ok'=>true, 'item'=>$search], 200);
        }
        return back()->with('status','Actualizado');
    }

    public function destroy(Search $search)
    {
        $search->delete();
        return request()->wantsJson()
            ? response()->json(['ok'=>true], 200)
            : back()->with('status','Eliminado');
    }
    protected function saveImageFile($file): string
{
    $dir = public_path('image/productos');

    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $filename = uniqid('prod_') . '.' . $file->getClientOriginalExtension();
    $file->move($dir, $filename);

    return $filename;
}

}
