<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品管理</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-[100vh]">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
            <a href="/" class="text-white text-xl">商品管理画面</a>
            </div>
        </div>
    </header>
 
    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <p class="text-2xl font-bold text-center">新規商品情報</p>
                <form action="/lists" method="post" class="mt-10"><!--  フォーム　 -->
                  @csrf
 
                  <div class="flex flex-col items-center">
                    <label class="w-full max-w-3xl mx-auto">
                        <p class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">商品名</p>
                        <input
                            class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                            placeholder="例：○○××△△" type="text" name="product_name" />
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
                        <input
                            class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                            placeholder="例：999999" type="text" name="product_price" />
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
                                    <option value={{ $categories_item->id }}>
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
 
                    <button type="submit" class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                        追加する
                    </button>
                  </div>
                </form><!--  フォーム　 -->
                <!--  商品リスト表示　 -->
                @if ($product_lists->isNotEmpty())
                    <div class="max-w-7xl mx-auto mt-20">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-blue-100">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                商品一覧</th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                <form id="category_s_form" >
                                                    <select name="category_s" id="category_s">
                                                        <option value="" {{ $category_s == '' ? 'selected': '' }}>
                                                            全てのカテゴリー
                                                        </option>
                                                        @if ($categories->isNotEmpty())
                                                            @foreach ($categories as $categories_item)
                                                                <option value={{ $categories_item->id }}
                                                                    {{ $category_s == $categories_item->id ? 'selected': '' }} >
                                                                    {{ $categories_item->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </form>
                                            </th>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                <form id="productsort_form" >
                                                    <select name="productsort" id="productsort">
                                                        <option value="id|asc" {{ $productsort == 'id|asc' ? 'selected': '' }}>
                                                            ID（昇順）
                                                        </option>
                                                        <option value="id|desc" {{ $productsort == 'id|desc' ? 'selected': '' }}>
                                                            ID（降順）
                                                        </option>
                                                        <option value="name|asc" {{ $productsort == 'name|asc' ? 'selected': '' }}>
                                                            商品名（昇順）
                                                        </option>
                                                        <option value="name|desc" {{ $productsort == 'name|desc' ? 'selected': '' }}>
                                                            商品名（降順）
                                                        </option>
                                                        <option value="price|asc" {{ $productsort == 'price|asc' ? 'selected': '' }}>
                                                            価格（昇順）
                                                        </option>
                                                        <option value="price|desc" {{ $productsort == 'price|desc' ? 'selected': '' }}>
                                                            価格（降順）
                                                        </option>
                                                        <option value="category|asc" {{ $productsort == 'category|asc' ? 'selected': '' }}>
                                                            カテゴリー名（昇順）
                                                        </option>
                                                        <option value="category|desc" {{ $productsort == 'category|desc' ? 'selected': '' }}>
                                                            カテゴリー名（降順）
                                                        </option>
                                                        <option value="updated_at|asc" {{ $productsort == 'updated_at|asc' ? 'selected': '' }}>
                                                            更新日（昇順）
                                                        </option>
                                                        <option value="updated_at|desc" {{ $productsort == 'updated_at|desc' ? 'selected': '' }}>
                                                            更新日（降順）
                                                        </option>
                                                    </select>
                                                </form>
                                            </th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">操作</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($product_lists as $product_item)
                                            <tr>
                                                <td class="px-3 py-4 text-sm text-black-500">
                                                    <div>
                                                        <p>ID：{{ $product_item->id }}</p>
                                                    </div>
                                                    <div>
                                                        <p>商品名：{{ $product_item->name }}</p>
                                                    </div>
                                                    <div>
                                                        <p>価格：{{ $product_item->price }}円</p>
                                                    </div>
                                                    <div>
                                                        <p>カテゴリー：{{ $product_item->category->name }}</p>
                                                    </div>
                                                </td>
                                                <td class="p-0 text-right text-sm font-medium">
                                                    <div class="flex justify-end">
                                                        <div>
                                                            <a href="/lists/{{ $product_item->id }}/edit/" class="inline-block text-center py-4 w-20 underline underline-offset-2 text-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>
                                                        </div>
                                                        <div>
                                                            <form onsubmit="return deleteTask();"
                                                                id = "deleteform"
                                                                action="/lists/{{ $product_item->id }}" method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="py-4 w-20 md:hover:bg-slate-200 transition-colors">削除</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $product_lists->links() }}
                @endif
                <!--  商品リスト表示　 -->
            </div>
        </div>
    </main>
    <footer class="bg-slate-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="py-4 text-center">
            <p class="text-white text-sm">商品管理画面</p>
        </div>
    </div>
    </footer>
    <script>
      function deleteTask() {
          if (confirm('商品を削除しますか？')) {
              return true;
          } else {
              return false;
          }
      }
      $(function() {
            $('#category_s').change(function () {
                $('#category_s_form').submit();
            });
        });
      $(function() {
            $('#productsort').change(function () {
                $('#productsort_form').submit();
            });
        });
    </script>
</body>
 
</html>