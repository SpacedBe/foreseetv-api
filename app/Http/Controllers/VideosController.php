<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Collection;
use App\Video;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class VideosController extends Controller
{
    public function __construct()
    {
    }

    public function create($collectionId, Request $request)
    {
        $info = Youtube::getVideoInfo($request->videoid);

        if (!$info || !$info->status->embeddable) {
            Session::flash('error', 'Video not embeddable.');

            return redirect()->action(
                'CollectionsController@edit', ['id' => $collectionId]
            );
        }

        // throw error
        if (!Video::where('video_id', '=', $info->id)->where('collection_id', '=', $collectionId)->get()->isEmpty()) {
            Session::flash('error', 'Video already in collection.');

            return redirect()->action(
                'CollectionsController@edit', ['id' => $collectionId]
            );
        }

        $video = $this->createVideo($info);

        // set relationship
        $collection = Collection::find($collectionId);
        $collection->videos()->save($video);

        Session::flash('message', 'Video added.');
        Session::flash('new_video_id', $video->id);

        return redirect()->action(
            'CollectionsController@edit', ['id' => $collectionId]
        );
    }

    public function youtubeAdd($collectionId, Request $request)
    {
        $info = Youtube::getVideoInfo($request->videoid);

        if (!$info || !$info->status->embeddable) {
            abort(500, 'not embeddable');
        }

        // throw error
        if (!Video::where('video_id', '=', $info->id)->where('collection_id', '=', $collectionId)->get()->isEmpty()) {
            abort(500, 'video already added');
        }

        $video = $this->createVideo($info);

        // set relationship
        $collection = Collection::find($collectionId);
        $collection->videos()->save($video);
    }

    public function delete($videoId)
    {
        $video = Video::find($videoId);

        $video->delete();

        return redirect()->action(
            'CollectionsController@edit', ['id' => $video->collection_id]
        );
    }

    public function massImport()
    {
        $videos = [
            "Zapzv57ZsF4",
            "LuyRPaEquyo",
            "FavUpD_IjVY",
            "k_5zELmun9E",
            "NKIWUqgIjq0",
            "pAwR6w2TgxY",
            "d9s6Vi-Ts-k",
            "I1gewNVv1UY",
            "WF34N4gJAKE",
            "8uGDw73IY0Y",
            "KvXtRVifAXE",
            "WfGMYdalClU",
            "A-rEb0KuopI",
            "aPAkcB5JgYc",
            "DoxUiqUpkw4",
            "hAwhSA3Btvw",
            "-RUt-3dwWaQ",
            "ZDqWf6I5mcI",
            "RZogqgxH4Mc",
            "RZogqgxH4Mc",
            "_sGByyJ2dS8",
            "NormmW0Bz4A",
            "uOUjnJrw1yQ",
            "tloE6yXpOHg",
            "XWDD0kml9FU",
            "gVdz7IZ5A_g",
            "kzSM6Hpv0xY",
            "3NPxqXMZq7o",
            "kfoJUeyMsOE",
            "6QFwo57WKwg",
            "GTV5Pcs5Q8U",
            "5jN3Bln4XXU",
            "EPdPR_jiWSg",
            "1d5FbdlVhd4",
            "ERCEryewpxM",
            "paPDvpT1W8Q",
            "yNe1pZipKK0",
            "mc42Zy8h0bI",
            "dtoJy--3BJA",
            "UsIh7qSvzwQ",
            "IdY91wTPAFc",
            "7OUUJvXW_gk",
            "OqWHeofXP6Q",
            "8oL6u9eujSU",
            "wpYZsKYUzOI",
            "41kDpFYlhUI",
            "ZA7AaqMsgeI",
            "5PAsyNzZopc",
            "81WiLVGgQp4",
            "gLsyCxmcOAw",
            "6EUcbbQdcV8",
            "yml1lwsO6Zs",
            "_pzSvyAun0o",
            "NwWNydPtwiQ",
            "qFmVP6vePFo",
            "Ht6oWQVmuD0",
            "wBqM2ytqHY4",
            "AdYaTa_lOf4",
            "1Dkq6Lp8_gg",
            "WbG1lPDFYBI",
            "vlUR09yRHZU",
            "9RHFFeQ2tu4",
            "VJ5QvrGxTnQ",
            "S530Vwa33G0",
            "mSHEd-2ut3I",
            "rEUxlwb2uFI",
            "WTfdqPutk5Y",
            "2pJuY6yTNhU",
            "pmg_j3IyEG8",
            "NhheiPTdZCw",
            "js9EY7iHNfs",
            "7YdH18U2OLM",
            "ofmhJPANtZ0",
            "IddDWBpkzYg",
            "5WaoImXPMtE",
            "TzzrzGyKo6g",
            "5hPS-3zQCzQ",
            "DoX8GMH4s1A",
            "8Q2P4LjuVA8",
            "G-Wn48geCJ8",
            "CqL6kkMTjRw",
            "joI6Dg1uNBY",
            "p4XTE-Pz3rI",
            "HfrPf9IgHjI",
            "DwVm9MRJVFc",
            "NlroNkIOX28",
            "XeFxdkaFzRA",
            "F5FEj9U-CJM",
            "Ce5mRvkAePU",
            "UR_byRbXxvs",
            "Q1zbgd6xpGQ",
            "6Jz0JcQYtqo",
            "AJFRvkNF6Wg",
            "TuN3XAHZ80A",
            "u9ssa-N2biY",
            "-0Xa4bHcJu8",
            "TgqiSBxvdws",
            "tKrT2pR7tGM",
            "qN3kC_4xURA",
            "WQO-aOdJLiw",
            "jX3iLfcMDCw",
            "TR_8SDNQ0ks",
            "SuQGfk9Gmgo",
            "Mf6JCpJjdiY",
            "UZV-rauHTyw",
            "bCArpwzIIx8",
            "sao3NAapOAI",
            "5zj3aHgLFQE",
            "VvnizNlna1k",
            "dqBOqEy7GKg",
            "0eoVLfPszeQ",
            "pD0Ioz8IqIQ",
            "pZIU4z95LkE",
            "W2ZTVYHsNyA",
            "4PMJihr4nY8",
            "ZWrUEsVrdSU",
            "7NaQnAkO2wU",
            "CxCqeZESSkA",
            "iUiV1XemMXA",
            "yubUVy34nrE",
            "_dNht9Zr0CE",
            "QxyPrXp2LLM",
            "TZkQ65WAa2Q",
            "VBCkK1Kd8L0",
            "7rJSqUQItgw",
            "MWowQub_jVU",
            "ZDykTjFFNIE",
            "th0LBpscgdg",
            "NPbGHpOrjEo",
            "l_4O3jS6Uiw",
            "htuTKyiJWnk",
            "27k7ARJ7NCw",
            "eQzZ_Wr1m5U",
            "0xgboqLY_Iw",
            "UHz0XU624-M",
            "gkQoCCsu_fA",
            "dwAv6vla9S4",
            "gMGp-o1UpeM",
            "hXEhVJ-zo_M",
            "zCQgGsHV_-I",
            "yI6Kw-7CFGM",
            "lR9ICvcBYZg",
            "M3i8zU4FFTg",
            "HezXYS5fgQQ",
            "RrlFvYUhZ1Q",
            "xyZnIAU9yXw",
            "ITLZefT74w4",
            "wUCcoT_daF8",
            "OWa5rzEOumQ",
            "9bmWAZbFPqI",
            "FdE3butAwxU",
            "xNa1Ftc5sWc",
            "exwn2X9RKXw",
            "svakc8t1UYY",
            "TwIEOkZ-e7I",
            "eESjNNdE9D4",
            "0FBKE9wItd4",
            "Nd5CygPXwK4",
            "QglMzJT35Og",
            "bJEB30Hdb4I",
            "LFB7zgDXtjo",
            "j7uFw6jCf3I",
            "ScAsA_X60GY",
            "m6k-GEvlnnM",
            "GrqWdUt6WpE",
            "xXLZo1k8JZU",
            "9mJSzU2-iDg",
            "c-M7cvJy1IY",
            "udAHb_BIcbs",
            "WDeCmK9dH04",
            "MUXnwE-BJlQ",
            "WPlq6C_Wtr4",
            "Br2EIkwbtmY",
            "0kCgMJ36dAg",
            "CwX1am9Uq5o",
            "efnsrLg03e4",
            "evdByn5O7nI",
            "QtYm5CA1CMw",
            "52ltv1j43Ig",
            "sm5ARfxfVAo",
            "t8YPJDGPxmg",
            "hlv2ofQ2-g4",
            "3EowUmX3Nss",
            "nmd4GLg-hwE",
            "oEL2q5YaZRk",
            "DAjxaFLEN2Q",
            "osbd7x1cYqA",
            "ojofvfeA3Fg",
            "NG7rNmbRccM",
            "5UsBNTBTpko",
            "Hn_Nf1tUnFM",
            "ATysZlPNLIQ",
            "o3hGNyAFu5g",
            "X91ZQrMvb-w",
            "TYnDe7u9XKo",
            "onbY6iPnt0U",
            "tqwyOkEMQ3s",
            "95jbo3HhnEg",
            "XT9UZIxwqCs",
            "USc5h9T-mX4",
            "C89a8o5_sxc",
            "mmVDnXk5xGI",
            "ozHJ7HVl_iU",
            "yLNbknm8aUQ",
            "Kjp6gVXgaKE",
            "QQPhROauGK4",
            "-t4EUL1aP8g",
            "b2i1gNfyxls",
            "3pLWskANffo",
            "BI-mYYbjxfs",
            "wvWG0FjAjp0"
        ];
        $collection = Collection::find(1);

        $added = 0;
        $rejected = 0;
        $duplicate = 0;

        foreach ($videos as $id) {
            $info = Youtube::getVideoInfo($id);

            if ($info && $info->status->embeddable) {
                $video = $this->createVideo($info);

                if (Video::where('video_id', '=', $info->id)->where('collection_id', '=', 1)->get()->isEmpty()) {
                    $collection->videos()->save($video);

                    $added += 1;
                } else {
                    $duplicate += 1;
                }
            } else {
                $rejected += 1;
            }
        }

        echo 'added : ' . $added . '<br>';
        echo 'rejected : ' . $rejected . '<br>';
        echo 'duplicate : ' . $duplicate . '<br>';
    }

    private function createVideo($data)
    {
        $video = new Video();
        $video->video_id = $data->id;
        $video->title = $data->snippet->title;
        $video->image = $data->snippet->thumbnails->high->url;
        $video->status = 'embedable';

        $video->save();

        return $video;
    }
}
