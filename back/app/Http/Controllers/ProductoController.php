<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Producto;
class ProductoController extends Controller
{
    function index(Request $request){
        $limit=$request->query('limit',10);
        $search=$request->query('search','');
        if($search){
            $productos=Producto::with('categoria')
            ->where('nombre','like','%'.$search.'%')
            ->orWhere('descripcion','like','%'.$search.'%')
            ->paginate($limit);
            return $productos;
        }
        $productos=Producto::with('categoria')->paginate($limit);
        return $productos;
    }

    function store(Request $request){

        // $imagen=$request->file('imagen');
        // $ruta=$imagen->store('public/imagenes');
        // $nombrearchivo=basename($ruta);
        $imagen=$request->file('imagen');
        $nombrearchivo=time().'_'.$imagen->getClientOriginalName();
        $imagen->move(public_path('imagenes'),$nombrearchivo);
        $producto=new Producto();
        $producto->nombre=$request->nombre;
        $producto->descripcion=$request->descripcion;
        $producto->lote=$request->lote;
        $producto->precio=$request->precio;
        $producto->imagen=$nombrearchivo;
        $producto->fecha_vencimiento=$request->fecha_vencimiento;
        $producto->unidad_medida=$request->unidad_medida;
        $producto->categoria_id=$request->categoria_id;
        $producto->save();
        return $producto;
    }
    function show($id){
        $producto=Producto::with('categoria')->find($id);
        if($producto){
            return $producto;
        }else{
            return response()->json(['message'=>'Producto no encontrado'],404);
            }
    }
    function destroy($id){
        $producto=Producto::find($id);
        if($producto){
            $producto->delete();
            return response()->json(['message'=>'Producto eliminado correctamente']);
        }else{
            return response()->json(['message'=>'Producto no encontrado'],404);
        }
    }
    function update(Request $request, $id){
        $producto=Producto::find($id);
        if($producto){
            $producto->nombre=$request->nombre;
            $producto->descripcion=$request->descripcion;
            $producto->lote=$request->lote;
            $producto->precio=$request->precio;
            if($request->hasFile('imagen')){
                $imagen=$request->file('imagen');
                $nombrearchivo=time().'_'.$imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'),$nombrearchivo);
                $producto->imagen=$nombrearchivo;
            }
            $producto->fecha_vencimiento=$request->fecha_vencimiento;
            $producto->unidad_medida=$request->unidad_medida;
            $producto->categoria_id=$request->categoria_id;
            $producto->save();
            return response()->json(['message'=>'Producto actualizado correctamente','producto'=>$producto  ],200);
        }else{
            return response()->json(['message'=>'Producto no encontrado'],404);
        }
    }

}
