<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Usamamuneerchaudhary\Commentify\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacanciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $vacancies = Vacancy::where('user_id', $userId)
            ->latest('updated_at')
            ->paginate(3);

        $comments = Comment::where('user_id', $userId)->get();

        return view('vacancies.index')->with(['vacancies' => $vacancies, 'comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:vacancies|max:255',
            'body' => 'required',
            'image_path' => 'url',
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5'
        ]);

        $vacancy =  Vacancy::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'image_path' => $request->image_path,
            'time_to_read' => $request->time_to_read,
            'is_published' => $request->is_published === 'on' ? '1' : '0',
            'priority' => $request->priority,
        ]);

        return to_route('vacancies.index')->with('success','Vacancy added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vacancy = Vacancy::where('id',$id)
            ->where('user_id',Auth::id())
            ->firstOrFail();

        return view('vacancies.show')->with('vacancy', $vacancy);

    }

    /**
     * Show the form for editing the specified resource.
     */
     
        public function edit(string $id)
        
        {
            $vacancy = Vacancy::findOrFail($id);
            if($vacancy->user_id != Auth::id()) {
                return abort(403);
            }
    
            return view('vacancies.edit')->with(['vacancy' => $vacancy]);
        }
     
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        if($vacancy->user_id != Auth::id()) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:255|unique:vacancies,title,' . $id,
            'body' => 'required',
            'image_path' => 'url',
            'time_to_read' => 'min:1|max:10',
            'priority' => 'min:1|max:5',
        ]);

        $vacancy->title = $request->input('title');
        $vacancy->body = $request->input('body');
        $vacancy->image_path = $request->input('image_path');

        $vacancy->time_to_read = $request->input('time_to_read');
        if ($request->has('is_published'))
        {
            $vacancy->is_published = 1;
         }
         else{
            $vacancy->is_published = 0;
         }
        $vacancy->priority = $request->input('priority');

        $vacancy->update();

        return to_route('vacancies.show', $vacancy)->with('success','Job was updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
         if(!$vacancy->user->is(Auth::user())) {
            return abort(403);
         }
         $vacancy->delete();
         return to_route('vacancies.index');
    }
}

