<?php

namespace Hdelima\PicPayGateway\Controller;

use Illuminate\Http\Request;
use App\Models\PicPayNotification;
use App\Http\Controllers\Controller;

class PicPayNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PicPayNotification::query();

        query_page($query, $request);

        query_sort(new PicPayNotification(), $query, $request);

        $query->when($request->status. function( $query ) use ( $request ) {
            return $query->whereStatus(\Str::upper($request->status));
        });

        return response()->json(
            response_format(false, query_limit($query, $request, 'query|picpay'))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $xSellerToken = $request->header('x-seller-token', null);

        $request->merge(['seller' => $xSellerToken]);

        $request->validate([
            'referenceId'       => 'required',
            'seller'            => 'required',
            'authorizationId'   => 'nullable',
        ]);

        $request->merge(['order_id' => $request->referenceId ]);

        PicPayNotification::createOrUpdate([
            'order_id' => $request->order_id
        ],[
            'seller' => $request->seller,
            'authorizationId' => $request->authorizationId
        ]);

        return response()->json( null );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $query = PicPayNotification::query();

        $notification = $query->findOrFail($id);

        return response()->json(response_format(false, $notification));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'seller'            => 'nullable',
            'authorizationId'   => 'nullable',
            'status'            => 'nullable',
        ]);

        $notification = PicPayNotification::findOrFail($id);

        $notification->update($request->only([
            'seller',
            'authorizationId',
            'status'
        ]));

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(null, 204);
    }
}
