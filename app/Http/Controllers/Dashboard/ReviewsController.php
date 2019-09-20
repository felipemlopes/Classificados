<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\dashboard\review\UpdateReviewRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Trexology\ReviewRateable\Models\Rating;


class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar reviews')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $reviews = Rating::Query();
        if ($search <> "") {
            $reviews->where(function ($q) use ($search) {
                $q->orwhere('title', "like", "%{$search}%");
                $q->orwhere('body', "like", "%{$search}%");
            });
        }

        $reviews = $reviews->paginate($peer_page);
        if ($search) {
            $reviews->appends(['search' => $search]);
        }

        return view('dashboard.review.list', compact('reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $permission_id
     * @return \Illuminate\Http\Response
     */
    public function edit($review_id)
    {
        if(!Auth::user()->can('Editar reviews')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $edit = true;
        $review = Rating::find($review_id);

        return view('dashboard.review.edit',compact('edit', 'review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, $review_id)
    {
        if(!Auth::user()->can('Editar reviews')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $review = Rating::find($review_id);
        $review->title = $request->title;
        $review->body = $request->body;
        $review->save();

        return redirect()->back()->withSuccess('Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($review_id)
    {
        if(!Auth::user()->can('Excluir reviews')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $review = Rating::find($review_id);
        $review->delete();

        return redirect()->route('dashboard.review.list')->withSuccess('Avaliação excluida com sucesso!');
    }
}
