<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaneFormRequest;
use App\Models\Brand;
use App\Models\Plane;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $pagesize = config('common.default_page_size');
        // nhận dữ liệu từ form gửi lên & thực hiện filter
        $planeQuerry = Plane::where('name', 'like', "%".$request->keyword."%");

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
        // 1. dựa vào model Product lấy toàn bộ data trong db
        $brands = Brand::all();
        $planes = $planeQuerry->paginate($pagesize);
        $planes->appends($request->except('page'));
        // dd($planes->currentPage());
        // 2. sinh ra màn hình danh sách với dữ liệu đã lấy đc
        return view('admin.plane.index', 
            [
                'plane_data' => $planes,
                'brands' => $brands,
            ]);
        }

        //
        public function remove($id){
            Plane::destroy($id);
            return redirect()->back();
        }

        public function editForm($id){
            $planes = Plane::find($id);
            if(!$planes){
                return redirect()->back();
            }
            $brands = Brand::all();
            return view('admin.plane.edit-form', compact('planes', 'brands'));
        }
        public function saveEdit($id, PlaneFormRequest $request){
            $model = Plane::find($id);
            if(!$model){
                return redirect(route('plane.index'));
            }
            $model->fill($request->all());
            if($request->hasFile('file_upload')){
                $newFileName = uniqid(). '-'.$request->file_upload->getClientOriginalName();
                $path = $request->file_upload->storeAs('public/uploads/planes', $newFileName);
                $model->image = str_replace('public/','',$path);
            }
            // lưu ảnh
            $model->save();
            return redirect(route('plane.index')); 
        }
        public function addForm(){
            $brands = Brand::all();
            return view('admin.plane.add-form', compact('brands'));
        }
        public function saveAdd(PlaneFormRequest $request){
            $model = new Plane();
            // gán giá trị cho các thuộc tính của object sử dụng massassign ($fillable trong model)
            $model->fill($request->all());
            if($request->hasFile('file_upload')){
                $newFileName = uniqid(). '-'.$request->file_upload->getClientOriginalName();
                $path = $request->file_upload->storeAs('public/uploads/planes', $newFileName);
                $model->image = str_replace('public/','',$path);
            }
            // lưu ảnh
            $model->save();
            return redirect(route('plane.index'));
        }
}
