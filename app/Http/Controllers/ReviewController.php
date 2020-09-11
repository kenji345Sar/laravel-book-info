<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

use App\Review;
use App\Tag;


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

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('reviews.create', [
            'allTagNames' => $allTagNames,
        ]);
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

        $request->tags->each(function ($tagName) use ($review) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $review->tags()->attach($tag);
        });

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
        $tagNames = $review->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('reviews.edit', [
            'review' => $review,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);

    }

    public function update(ReviewRequest $request, Review $review)
    {

        $review->fill($request->all())->save();

        $review->tags()->detach();
        $request->tags->each(function ($tagName) use ($review) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $review->tags()->attach($tag);
        });

        return redirect()->route('reviews.index');
    }


    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index');
    }

    public function like(Request $request, Review $review)
    {
        $review->likes()->detach($request->user()->id);
        $review->likes()->attach($request->user()->id);

        return [
            'id' => $review->id,
            'countLikes' => $review->count_likes,
        ];
    }

    public function unlike(Request $request, Review $review)
    {
        $review->likes()->detach($request->user()->id);

        return [
            'id' => $review->id,
            'countLikes' => $review->count_likes,
        ];
    }

}
