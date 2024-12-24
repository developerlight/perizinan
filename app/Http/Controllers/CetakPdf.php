<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakPdf extends Controller
{
    public function index(Request $request)
    {
        $query = Permit::query();

        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('tanggal_mulai', $request->month);
        }

        if ($request->has('year') && $request->year != '') {
            $query->whereYear('tanggal_mulai', $request->year);
        }

        if ($request->has('role') && $request->role != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        $permits = $query->with('user')->get();
        $permits->load(['user.teacher', 'user.student']);
        // dd($permits);

        return view('permit.report', compact('permits'));
    }

    public function generatePdf(Request $request)
    {
        try {
            $query = Permit::query();
            
            if ($request->has('month') && $request->month != '') {
                $query->whereMonth('tanggal_mulai', $request->month);
            }
    
            if ($request->has('year') && $request->year != '') {
                $query->whereYear('tanggal_mulai', $request->year);
            }
    
            if ($request->has('role') && $request->role != '') {
                $query->whereHas('user', function($q) use ($request) {
                    $q->where('role', $request->role);
                });
            }
    
            $permits = $query->with('user')->get();
            $permits->load(['user.teacher', 'user.student']);
                
            // $html = view('permit.pdf', compact('permits'))->render();
            
            $pdf = Pdf::loadView('permit.pdf', compact('permits'));

            return $pdf->download('permits.pdf');

            // $options = new Options();
            // $options->set('isHtml5ParserEnabled', true);
            // $options->set('isRemoteEnabled', true);
            // $dompdf = new Dompdf($options);
            // $dompdf->loadHtml($html);
            // $dompdf->setPaper('A4', 'landscape');
            // $dompdf->render();
            // return $dompdf->stream('laporan_perizinan.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
