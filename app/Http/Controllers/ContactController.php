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
        return view('contacts.create');
    }
    public function show(int $id = null)
    {
        $contact = Contact::find($id);
        return view('contacts.show',compact('contact'));
    }
}
