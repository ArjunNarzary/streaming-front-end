<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SubscriptionPlan;

use App\Subscriber;

use App\SubscriberBilling;

use Carbon\Carbon;

class SubscriptionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $plans = SubscriptionPlan::all();
        return view('subscription.index',compact('plans'));
    }

    public function subscribe($id)
    {
        $plan = SubscriptionPlan::find($id);
        // get the current time
        $current = Carbon::now();
        
        // add Time Period to the current time
        $plan_expiry = $current->addMonth($plan->time_period);

        $subscriber = Subscriber::where('user_id',Auth()->user()->id)->first();
        if($subscriber != NULL)
        {
            $subscriber->plan_expiry = $plan_expiry;
            $subscriber->status = 1;
            $subscriber->save();
        }
        else
        {
            $subscriber = new Subscriber;
            $subscriber->user_id = Auth()->user()->id;
            $subscriber->plan_expiry = $plan_expiry;
            $subscriber->status = 1;
            $subscriber->save();
        }
            $billing = new SubscriberBilling;
            $billing->subscriber_id = $subscriber->id;
            $billing->subscription_plan_id = $id;
            $billing->payment_status = 1;
            $billing->save();
        
       return view('subscription.subscription-successful',compact('plan'));
    }
}
