<?php
namespace App\Http\Controllers;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        
        $promo = Promotion::where('code', $request->code)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if ($promo) {
            session(['promo_discount' => $promo->discount_amount, 'promo_code' => $promo->code]);
            return back()->with('success', 'Code promo appliqué !');
        }

        return back()->with('error', 'Code promo invalide ou expiré.');
    }

    public function remove()
    {
        session()->forget(['promo_discount', 'promo_code']);
        return back()->with('success', 'Code promo retiré.');
    }
}