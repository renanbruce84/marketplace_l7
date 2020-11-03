<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Traits\Uploadtrait;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    use Uploadtrait;

    private $product;

    public function __construct(Product $product)
    {
        $this->middleware('store.has.products')->only(['index']);
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = $user->store->product()->paginate(10);

        return view('admin.products.index', compact('products'));

        // TODO: Ter acesso a esta área apenas quando houver Loja cadastrada
        // $user = Auth::user();
        // if($user->store()->count()){        
        //     $products = $user->store->product()->paginate(10);    
        //     return view('admin.products.index', compact('products'));                        
        // }
        // return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();   
        
        // $categories = $request->get('categories', null);

        // Criando uma produto para uma loja   
        $product = Auth::user()->store->product()->create($data);
        // Syncronizando a criação desse produto com uma categoria através da tabela category_table 
        $product->category()->sync($data['categories']);
        // $product->category()->sync($categories);

        // Imagens
        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);
        }

        flash('Produto criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->findOrFail($product);
        $categories = \App\Category::all('id', 'name');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        
        $product = $this->product->find($product);
        $product->update($data);

        //  Recupera todas as categorias salvas para o produto e 
        $categories = $data['categories'];        

        if ($categories) {
            $product->category()->sync($categories); // Atualiza a categoria que esta em outra tabela
        }

        // Imagens
        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            $product->photos()->createMany($images);
        }

        flash('Produto atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = $this->product::find($product);
        $product->delete();
        flash('Produto removido com sucesso')->success();
        return redirect()->route('admin.products.index');
    }
}
