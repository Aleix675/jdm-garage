<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Tag;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller
{
    public function index()
    {
        $query = Car::with(['user', 'tags'])->latest();

        if (request('brand')) {
            $query->where('brand', 'like', '%' . request('brand') . '%');
        }
        if (request('year')) {
            $query->where('year', request('year'));
        }
        if (request('tag')) {
            $query->whereHas('tags', fn($q) => $q->where('tags.id', request('tag')));
        }

        $cars = $query->paginate(12)->withQueryString();
        $tags = Tag::orderBy('name')->get();

        return view('cars.index', compact('cars', 'tags'));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('cars.create', compact('tags'));
    }

    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('cars', 'public');
        }

        $car = Car::create($data);
        $car->tags()->sync($request->input('tags', []));

        return redirect()->route('cars.show', $car)->with('success', 'Cotxe afegit correctament!');
    }

    public function show(Car $car)
    {
        $car->load(['user', 'tags']);
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $this->authorize('update', $car);
        $tags = Tag::orderBy('name')->get();
        return view('cars.edit', compact('car', 'tags'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->authorize('update', $car);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);
        $car->tags()->sync($request->input('tags', []));

        return redirect()->route('cars.show', $car)->with('success', 'Cotxe actualitzat!');
    }

    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Cotxe eliminat.');
    }
}
