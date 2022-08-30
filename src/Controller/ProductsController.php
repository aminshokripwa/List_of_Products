<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/api/v1/products', name: 'products')]
    public function index(Request $request): JsonResponse
    {
        // Read Products list from json file
        // If u use sql query to get products list ,it is better to apply category and priceLessThan and pagination(offset,limit) filter inside query
        $products = json_decode(file_get_contents(__DIR__.'/data.json'))->products;
        $page = $request->query->get("page") ?? 1;
        $limit = $request->query->get("limit") ?? 5; // data loaded in per page
        $offset = ($page-1); // for sql query u must use ($page-1) * $limit
        $category = $request->query->get("category") ?? false;
        $PriceLessThan = $request->query->get("PriceLessThan") ?? false;
        // Filtery by Category
        if ($category) {
            $products = array_filter($products, fn ($val, $key) => $val->category == $category, ARRAY_FILTER_USE_BOTH);
        }
        // Filter by PriceLessThan
        if ($PriceLessThan) {
            $products = array_filter($products, fn ($val, $key) => $val->price <= $PriceLessThan, ARRAY_FILTER_USE_BOTH);
        }
        // Read Discounts
        $discounts = json_decode(file_get_contents(__DIR__.'/discounts.json'), 1);

        // Apply Discount
        $products = array_map(function ($product) use ($discounts) {
            $product->price = (object)[
                "original" => $product->price,
                "final" => $product->price,
                "discount_percentage" => null,
                "currency" => "EUR"
            ];
            // Select bigger discount from discounts list
            // if u use this method u can apply discount percentage to all product column
            $discount = [];
            foreach ($discounts as $k=>$v) {
                foreach ($v as $kk=>$vv) {
                    if (isset($product->$k) && $kk == $product->$k) {
                        array_push($discount, $vv);
                        break;
                    }
                }
            }
            rsort($discount);
            $discount = $discount[0] ?? null;

            // this method limit two column for discount if u want u can use
            // if(isset($discounts['category'][$product->category])){
            //     $discount= $discounts['category'][$product->category];
            // }
            // if (isset($discounts['sku'][$product->sku]) && $discounts['sku'][$product->sku] > $discount) {
            //     $discount = $discounts['category'][$product->category];
            // }
            if ($discount) {
                $product->price->discount_percentage = "{$discount}%";
                $product->price->final = $product->price->original - ($product->price->original * ($discount/100));
            }
            return $product;
        }, $products);
        $allRecords = count($products);
        $allPages = ceil($allRecords / $limit);
        // separate products list to $limit array
        $pagination = array_chunk($products, $limit);
        $response = $pagination[$offset] ?? [];

        return new JsonResponse(['status' => 'success' ,'allRecords' => $allRecords,'page' => $page,'allPage' => $allPages,'products' => $response] , 200 );
    }
}
