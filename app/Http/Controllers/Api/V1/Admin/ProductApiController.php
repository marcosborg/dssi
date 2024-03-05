<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MailStore;
use App\Models\CrashPlan;
use App\Models\KSevenSecurity;
use App\Models\Wasabi;
use App\Models\Ubiquiti;
use App\Models\OwnCloud;

class ProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource(Product::with(['manufacturer', 'solution'])->get());
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        return(new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        $product = new ProductResource(
            $product->load(['manufacturer', 'solution'])
        );

        return $product;

    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        if (count($product->files) > 0) {
            foreach ($product->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return(new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function product($product_id)
    {
        $product = Product::find($product_id)->load(['manufacturer', 'solution']);

        switch ($product->manufacturer_id) {
            case 1:
                $titan_hqs = CrashPlan::where('product_id', $product_id)->get();
                $product->questions = [
                    'question_1' => 'number',
                    'question_2' => $titan_hqs->unique('term')->map(function ($term) {
                        return collect($term->term)->values()->all();
                    })->values()->all(),
                ];
                break;
            case 3:
                $crash_plans = CrashPlan::where('product_id', $product_id)->get();
                $product->questions = [
                    'question_1' => 'number',
                    'question_2' => $crash_plans->unique('term')->map(function ($term) {
                        return collect($term->term)->values()->all();
                    })->values()->all(),
                ];
                break;
            case 4:
                $k_seven_securities = KSevenSecurity::where('product_id', $product_id)->get();
                $product->questions = [
                    'question_1' => 'number',
                    'question_2' => $k_seven_securities->unique('term')->map(function ($term) {
                        return collect($term->term)->values()->all();
                    })->values()->all(),
                ];
                break;
            case 5:
                $wasabis = Wasabi::where('product_id', $product_id)->get();
                $product->questions = [
                    'question_1' => $wasabis->unique('tb')->map(function ($tb) {
                        return collect($tb->tb)->values()->all();
                    })->values()->all(),
                    'question_2' => $wasabis->unique('term')->map(function ($term) {
                        return collect($term->term)->values()->all();
                    })->values()->all(),
                ];
                break;
            case 8:
                $mail_stores = MailStore::where('product_id', $product_id)->get();
                $product->questions = [
                    'question_1' => 'number',
                    'question_2' => $mail_stores->unique('term')->map(function ($term) {
                        return collect($term->term)->values()->all();
                    })->values()->all(),
                ];
                break;
            case 9:
                $ubiquitis = Ubiquiti::where('product_id', $product_id)->get();
                $product->questions = [
                    'question_1' => $ubiquitis->unique('name')->map(function ($name) {
                        return collect($name->name)->values()->all();
                    })->values()->all(),
                    'question_2' => $ubiquitis->unique('description')->map(function ($description) {
                        return collect($description->description)->values()->all();
                    })->values()->all(),
                ];
                break;
            case 10:
                $own_clouds = OwnCloud::where('product_id', $product_id)->get();
                $product->questions = [
                    'question_1' => $own_clouds->unique('term')->map(function ($term) {
                        return collect($term->term)->values()->all();
                    })->values()->all(),
                    'question_2' => 'number',
                ];
                break;
            default:
                $product->questions = null;
                break;
        }

        return $product;
    }

    public function filter(Request $request)
    {
        $product = Product::find($request->product_id);

        switch ($product->manufacturer_id) {
            case 1:

                break;
            case 3:
                $crash_plans = CrashPlan::where([
                    'product_id' => $request->product_id,
                ])->get()->unique('term')->map(function ($product) {
                    return $product->term;
                });
                $questions = $crash_plans;
                break;
            case 4:
                $k_seven_securities = KSevenSecurity::where([
                    'product_id' => $request->product_id,
                ])->get()->unique('term')->map(function ($product) {
                    return $product->term;
                });
                break;
            case 5:
                $wasabis = Wasabi::where([
                    'product_id' => $request->product_id,
                    'tb' => $request->option1
                ])->get()->unique('tb')->map(function ($product) {
                    return $product->term;
                });
                $questions = $wasabis;
                break;
            case 8:
                $mail_stores = MailStore::where('from', '>=', $request->option1)
                    ->where('to', '<=', $request->option1)
                    ->get()->unique('term')->map(function ($product) {
                        return $product->term;
                    });
                $questions = $mail_stores;
                break;
            case 9:
                $ubiquitis = Ubiquiti::where([
                    'product_id' => $request->product_id,
                    'name' => $request->option1
                ])->get()->unique('description')->map(function ($product) {
                    return $product->description;
                });
                $questions = $ubiquitis;
                break;
            case 10:
                $questions = [];
                break;
            default:

                break;
        }

        return $questions;

    }

    public function search(Request $request)
    {
        $product = Product::find($request->product_id);

        switch ($product->manufacturer_id) {
            case 1:

                break;
            case 3:
                $crash_plans = CrashPlan::where('product_id', $request->product_id)
                    ->where('from', '>=', $request->option1)
                    ->where('to', '<=', $request->option1)
                    ->where('term', $request->option2)
                    ->first();
                $result = $crash_plans;
                break;
            case 4:
                $k_seven_securities = KSevenSecurity::where('product_id', $request->product_id)
                    ->where('term', $request->option2)
                    ->where('from', '>=', $request->option1)
                    ->where('to', '<=', $request->option1)
                    ->first();
                $result = $k_seven_securities;
                break;
            case 5:
                $wasabis = Wasabi::where([
                    'product_id' => $request->product_id,
                    'tb' => $request->option1,
                    'term' => $request->option2
                ])->first();
                $result = $wasabis;
                break;
            case 8:
                $mail_stores = MailStore::where('product_id', $request->product_id)
                    ->where('term', $request->option2)
                    ->where('from', '>=', $request->option1)
                    ->where('to', '<=', $request->option1)
                    ->first();
                $result = $mail_stores;
                break;
            case 9:
                $ubiquitis = Ubiquiti::where('product_id', $request->product_id)
                    ->where('name', $request->option1)
                    ->where('description', $request->option2)
                    ->first();
                $result = $ubiquitis;
                break;
            case 10:
                $own_clouds = OwnCloud::where('product_id', $request->product_id)
                    ->where('term', $request->option1)
                    ->where('from', '>=', $request->option2)
                    ->where('to', '<=', $request->option2)
                    ->first();
                $result = $own_clouds;
                break;
            default:

                break;
        }

        return $result;
    }

}