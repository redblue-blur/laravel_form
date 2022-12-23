import React, { useState } from 'react';
import '../css/home.css';
function Home() {

    return (
<>
<table class="table">
        <thead>
            <tr>
                <th>Product_id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Count</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)

            <tr>
                <th>{{$product->product_id}}</th>
                <th>{{$product->itemname}</th>
                <th>{{$product->price}}</th>
                <th>{{$product->count}}</th>
                <th>
                  <a href="{{route('product.edit',['id'=>$product->product_id])}}">
                    <button class="btn btn-primary">select</button>
                  </a>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</>
    );
  }
export default Home;