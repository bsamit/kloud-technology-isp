<?php

namespace App\Http;

use App\Models\User;
use App\Models\Helpdesk\Ticket;
use App\Models\Package\Packages;
use Spatie\Permission\Models\Role;
use App\Models\Package\PackageCategory;
use App\Models\Helpdesk\HelpdeskCategory;

class CommonList {

    public function getPackageList()
    {
        return Packages::where('status', 1)->get(['id', 'plan_name'])
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->plan_name
            ];
        });
    }
    public function getPackageCategoryList()
    {
        return PackageCategory::where('status', 1)->get(['id', 'name'])
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name
            ];
        });
    }

    public function getStaffRoleList()
    {
        return Role::whereNotIn('id', [1, 4])->orderBy('id', 'desc')->get(['id', 'name'])
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name
            ];
        });
    }

    public function getHelpdeskCategoryList()
    {
        return HelpdeskCategory::where('status', 1)->get(['id', 'helpdesk_category_name', 'status'])
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->helpdesk_category_name,
            ];
        });
    }
    
    public function getTicketList()
    {
        return Ticket::get(['id', 'user_id', 'package_id', 'ticket_category_id', 'subject', 'details', 'status', 'attachment'])
        ->map(function($item){
            return [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'package_id' => $item->package_id,
                'ticket_category_id' => $item->ticket_category_id,
                'subject' => $item->subject,
                'details' => $item->details,
                'attachment' => $item->attachment,
                'status' => $item->status,
            ];
        });
    }

    public function getAllActiveCustomerList()
    {
        return User::where('role_id', 4)->where('status', 1)->get(['uuid', 'name'])
        ->map(function($item){
            return [
                'id' => $item->uuid,
                'name' => $item->name
            ];
        });
    }

    public function getAllActivePackageList()
    {
        return Packages::with('packageCategory:id,name')->where('status', 1)->get(['uuid', 'plan_name', 'package_catgory_id'])
        ->map(function($item){
            return [
                'id' => $item->uuid,
                'name' => $item->packageCategory->name . ' - ' . $item->plan_name
            ];
        });
    }

}