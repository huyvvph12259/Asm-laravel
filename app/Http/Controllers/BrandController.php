<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandFormRequest;
use App\Models\Brand;
use App\Models\Plane;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request){
        $pagesize = config('common.default_page_size');
        $planeQuerry = Brand::where('name', 'like', "%".$request->keyword."%");

        if($request->has('brand_id') && $request->brand_id > 0){
            $planeQuerry->where('brand_id', $request->brand_id);
        }
        if($request->has('order_by') && $request->order_by > 0){
            if($request->order_by == 1){
                $planeQuerry->orderBy('name');
            }else if($request->order_by == 2){
                $planeQuerry->orderByDesc('name');
            }
        }
        
        $brands = $planeQuerry->paginate($pagesize);
        $brands->appends($request->except('page'));
        
        return view('admin.brand.index', 
            [
                'brands' => $brands,
            ]);
    }

    public function remove($id){
        
        
        
        $planes = Plane::where('brand_id', $id)->get();
        foreach ($planes as $key =>$item){
            $item->delete();
        }
        
        Brand::destroy($id);
        return redirect()->back();
    }
    public function editForm($id){
        $brands = Brand::find($id);
        if(!$brands){
            return redirect()->back();
        }
        return view('admin.brand.edit-form', compact('brands'));
    }
    public function saveEdit($id, BrandFormRequest $request){
        $model = Brand::find($id);
        if(!$model){
            return redirect(route('brand.index'));
        }
        $model->fill($request->all());
        
        
        if($request->hasFile('file_upload')){
            $newFileName = uniqid(). '-'.$request->file_upload->getClientOriginalName();
            $path = $request->file_upload->storeAs('public/uploads/brands', $newFileName);
            $model->image = str_replace('public/','',$path);
        }
        $model->save();
        return redirect(route('brand.index')); 
    }
    public function addForm(){
        $brands = Brand::all();
        return view('admin.brand.add-form', compact('brands'));
    }
    public function saveAdd(BrandFormRequest $request){
        $model = new Brand();
        
        $model->fill($request->all());
        
       
        if($request->hasFile('file_upload')){
            $newFileName = uniqid(). '-'.$request->file_upload->getClientOriginalName();
            $path = $request->file_upload->storeAs('public/uploads/brands', $newFileName);
            $model->image = str_replace('public/','',$path);
        }
        $model->save();
        return redirect(route('brand.index'));
    }
}
