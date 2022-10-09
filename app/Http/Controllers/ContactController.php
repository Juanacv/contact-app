<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactController extends Controller
{
    public function index() 
    {
        $companies = Company::orderBy('name')->pluck('name','id')->prepend('All companies','');
        $contacts = Contact::orderBy('first_name', 'asc')->where(function($query){
            if ($companyId = request('company_id')) {
                $query->where('company_id',$companyId);
            }            
        })->paginate(10);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        $contact = new Contact;
        $companies = Company::orderBy('name')->pluck('name','id')->prepend('Select company','');
        return view('contacts.create',compact('companies', 'contact'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id'
        ]);
        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('message','Contact has been added successfully');
    }

    public function edit(int $id)
    {
        $contact = Contact::findOrFail($id);
        $companies = Company::orderBy('name')->pluck('name','id')->prepend('Select company','');
        return view('contacts.edit',compact('companies','contact'));        
    }

    public function update(int $id, Request $request) 
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id'
        ]);
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message','Contact has been updated successfully');
    }
    
    public function show(int $id = null)
    {
        $contact = Contact::find($id);
        return view('contacts.show',compact('contact'));
    }

    public function destroy(int $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return back()->with('message','Contact has been deleted successfully');
    }
}

