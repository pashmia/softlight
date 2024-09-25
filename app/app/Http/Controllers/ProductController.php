<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Status;

class ProductController extends Controller
{
    /**
     * Получение всех продуктов (id, name, category, created_at)
     */
    public function index()
    {
        // Получаем продукты с категорией
        $products = Product::select('id', 'name', 'category_id', 'created_at')
            ->with('category:id,name')
            ->get();

        return response()->json($products);
    }

    /**
     * Создание нового продукта
     */
    public function store(Request $request)
    {
        // Валидация входящих данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'status_id' => 'required|exists:statuses,id'
        ]);

        // Создание нового продукта
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'user_id' => auth()->id(),  // ID аутентифицированного пользователя
            'category_id' => $validated['category_id'],
            'country_id' => $validated['country_id'],
            'status_id' => $validated['status_id'],
        ]);

        return response()->json($product, 201);
    }

    /**
     * Получение одного продукта (детальная информация)
     */
    public function show(Product $product)
    {
        // Подгружаем связанные данные
        $product->load(['category:id,name', 'country:id,name', 'status:id,name', 'user:id,name']);

        return response()->json($product);
    }

    /**
     * Обновление продукта (PUT/PATCH)
     */
    public function update(Request $request, Product $product)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'status_id' => 'required|exists:statuses,id'
        ]);

        // Обновляем продукт
        $product->update($validated);

        return response()->json($product, 200);
    }

    /**
     * Удаление продукта
     */
    public function destroy(Product $product)
    {
        // Удаляем продукт
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 204);
    }

    /**
     * Получение списка продуктов со статусом approved (для dropdown)
     */
    public function dropdown()
    {
        // Получаем только одобренные продукты
        $products = Product::where('status_id', Status::where('name', 'approved')->first()->id)
            ->select('id', 'name')
            ->get();

        return response()->json($products);
    }
}
