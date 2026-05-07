<div class="max-w-2xl mx-auto">
    <a href="{{ route('cars.index') }}" class="text-gray-400 hover:text-yellow-400 text-sm mb-6 inline-flex items-center gap-1 transition">
        ← Tornar
    </a>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mt-4">
        <h1 class="text-2xl font-bold mb-6">
            {{ isset($car) ? 'Editar ' . $car->brand . ' ' . $car->model : 'Afegir nou cotxe' }}
        </h1>

        <form method="POST"
              action="{{ isset($car) ? route('cars.update', $car) : route('cars.store') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf
            @isset($car) @method('PUT') @endisset

            {{-- BRAND + MODEL --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Marca <span class="text-red-400">*</span></label>
                    <input type="text" name="brand" value="{{ old('brand', $car->brand ?? '') }}"
                           class="w-full bg-gray-800 border @error('brand') border-red-500 @else border-gray-700 @enderror text-white rounded-lg px-3 py-2 focus:outline-none focus:border-yellow-400"
                           placeholder="ex: Toyota">
                    @error('brand') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Model <span class="text-red-400">*</span></label>
                    <input type="text" name="model" value="{{ old('model', $car->model ?? '') }}"
                           class="w-full bg-gray-800 border @error('model') border-red-500 @else border-gray-700 @enderror text-white rounded-lg px-3 py-2 focus:outline-none focus:border-yellow-400"
                           placeholder="ex: Supra">
                    @error('model') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- YEAR + ENGINE + COLOR --}}
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Any <span class="text-red-400">*</span></label>
                    <input type="number" name="year" value="{{ old('year', $car->year ?? '') }}"
                           min="1990" max="2005"
                           class="w-full bg-gray-800 border @error('year') border-red-500 @else border-gray-700 @enderror text-white rounded-lg px-3 py-2 focus:outline-none focus:border-yellow-400"
                           placeholder="1995">
                    @error('year') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Motor</label>
                    <input type="text" name="engine" value="{{ old('engine', $car->engine ?? '') }}"
                           class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2 focus:outline-none focus:border-yellow-400"
                           placeholder="ex: 2JZ-GTE">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Color</label>
                    <input type="text" name="color" value="{{ old('color', $car->color ?? '') }}"
                           class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2 focus:outline-none focus:border-yellow-400"
                           placeholder="ex: Negre">
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-sm text-gray-400 mb-1">Descripció</label>
                <textarea name="description" rows="3"
                          class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2 focus:outline-none focus:border-yellow-400 resize-none"
                          placeholder="Explica alguna cosa del teu cotxe...">{{ old('description', $car->description ?? '') }}</textarea>
                @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- IMAGE --}}
            <div>
                <label class="block text-sm text-gray-400 mb-1">Imatge</label>
                @isset($car)
                    @if($car->image_path)
                        <img src="{{ asset('storage/' . $car->image_path) }}" class="w-32 h-20 object-cover rounded-lg mb-2 border border-gray-700">
                    @endif
                @endisset
                <input type="file" name="image" accept="image/*"
                       class="w-full text-gray-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-700 file:text-gray-200 hover:file:bg-gray-600">
                @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- TAGS (M:M) --}}
            @if($tags->count())
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Etiquetes</label>
                    <div class="flex flex-wrap gap-2">
                       @foreach($tags as $tag)
                            <label class="cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="tags[]"
                                    value="{{ $tag->id }}"
                                    class="sr-only peer"
                                    {{ collect(old('tags', isset($car) ? $car->tags->pluck('id')->toArray() : []))->contains($tag->id) ? 'checked' : '' }}
                                >

                                <span
                                    class="px-3 py-1 rounded-full text-sm border transition peer-checked:font-semibold"
                                    style="border-color: {{ $tag->color }}55; color: {{ $tag->color }}"
                                >
                                    {{ $tag->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- SUBMIT --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-yellow-400 text-gray-900 px-6 py-2.5 rounded-lg font-bold hover:bg-yellow-300 transition">
                    {{ isset($car) ? 'Guardar canvis' : 'Afegir cotxe' }}
                </button>
                <a href="{{ route('cars.index') }}"
                   class="border border-gray-600 text-gray-400 px-6 py-2.5 rounded-lg hover:border-gray-400 transition">
                    Cancel·lar
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Tag checkbox visual feedback --}}
<style>
    input[type=checkbox]:checked + span {
        background-color: var(--tag-color, #3B82F622);
        font-weight: 600;
    }
</style>
