<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

use App\Review;


class ReviewController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Review::class, 'review');
    }
    //
    public function index()
    {
        $reviews = Review::where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);

        return view('reviews.index', compact('reviews'));
    }

    // public function show($id)
    // {
    //     dd($id);
    //     $review = Review::where('id', $id)->where('status', 1)->first();

    //     return view('reviews.show', compact('review'));
    // }

    public function show(Review $review)
    {
        return view('reviews.show', ['review' => $review]);
    }

    public function create()
    {
        return view('reviews.review');
    }

    public function store(ReviewRequest $request, Review $review)
    {
        $review->title = $request->title;
        $review->body = $request->body;
        $review->user_id = $request->user()->id;

        if ($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $review->image = $request->file('image')->hashName();
        }

        $review->save();
        return redirect()->route('reviews.index');
    }
    // public function store(Request $request)
    // {
    //     $post = $request->all();

    //     $validatedData = $request->validate([
    //         'title' => 'required|max:255',
    //         'body' => 'required',
    //         'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {

    //         $request->file('image')->store('/public/images');
    //         $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body'], 'image' => $request->file('image')->hashName()];
    //     } else {
    //         $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body']];
    //     }

    //     Review::insert($data);

    //     return redirect('/')->with('flash_message', '投稿が完了しました');

    // }

    public function edit(Review $review)
    {
        return view('reviews.edit', ['review' => $review]);
    }

    public function update(ReviewRequest $request, Review $review)
    {

        $review->fill($request->all())->save();

        return redirect()->route('reviews.index');
    }


    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index');
    }

}
