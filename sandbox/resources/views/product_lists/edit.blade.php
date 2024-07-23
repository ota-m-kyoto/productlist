<!DOCTYPE html>
  <html lang="ja">
  
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>商品情報編集</title>
  
  </head>
  <script src="https://cdn.tailwindcss.com"></script>
  <body class="flex flex-col min-h-[100vh]">
      <header class="bg-slate-800">
          <div class="max-w-7xl mx-auto px-4 sm:px-6">
              <div class="py-6">
                  <p class="text-white text-xl">商品情報編集画面</p>
              </div>
          </div>
      </header>
  
      <main class="grow grid place-items-center">
          <div class="w-full mx-auto px-4 sm:px-6">
              <div class="py-[100px]">
                  <form action="/lists/{{ $product->id }}" method="post" class="mt-10">
                      @csrf
                      @method('PUT')
  
                      <div class="flex flex-col items-center">
                      <label class="w-full max-w-3xl mx-auto">
                              <p class="py-3.5 pl-4 pr-3 text-left text-xl font-semibold text-gray-900">ID : {{ $product->id }}</p>
                          </label>
                          <label class="w-full max-w-3xl mx-auto">
                              <p class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">商品名</p>
                              <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="text" name="product_name" value="{{ $product->name }}" />
                              @error('product_name')
                                  <div class="mt-3">
                                      <p class="text-red-500">
                                          {{ $message }}
                                      </p>
                                  </div>
                              @enderror
                          </label>
                          <label class="w-full max-w-3xl mx-auto">
                              <p class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">価格</p>
                              <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="text" name="product_price" value="{{ $product->price }}" />
                              @error('product_price')
                                  <div class="mt-3">
                                      <p class="text-red-500">
                                          {{ $message }}
                                      </p>
                                  </div>
                              @enderror
                          </label>
                          <label class="w-full max-w-3xl mx-auto">
                              <p class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">カテゴリー</p>
                              <select id="category_l" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" name="product_category">
			          　　　　　　　<option value="">カテゴリーを選択してください</option>
                                  @if ($categories->isNotEmpty())
                                      @foreach ($categories as $categories_item)
                                          @if ($product->category_id == $categories_item->id)
                                              <option value={{ $categories_item->id }} selected>
                                          @else
                                              <option value={{ $categories_item->id }}>
                                          @endif
                                              {{ $categories_item->name }}
                                          </option>
                                      @endforeach
                                  @endif
		              　　　　　</select>
                              @error('product_category')
                                  <div class="mt-3">
                                      <p class="text-red-500">
                                          {{ $message }}
                                      </p>
                                  </div>
                              @enderror
                          </label>
                          <div class="mt-8 w-full flex items-center justify-center gap-10">
                              <a href="/lists" class="block shrink-0 underline underline-offset-2">
                                  戻る
                              </a>
                              <button type="submit" class="p-4 bg-sky-800 text-white w-full max-w-xs hover:bg-sky-900 transition-colors">
                                  保存する
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </main>
      <footer class="bg-slate-800">
          <div class="max-w-7xl mx-auto px-4 sm:px-6">
              <div class="py-4 text-center">
                  <p class="text-white text-sm">商品情報編集</p>
              </div>
          </div>
      </footer>
  </body>
  
  </html>