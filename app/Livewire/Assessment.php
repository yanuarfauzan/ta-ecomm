<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Assessment extends Component
{
    use WithPagination;

    public $arrayStars;
    public $product;
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $sortField = 'terbaru';
    public $filterByMedia = false;
    public $filterByStars = [];
    public $fiveStar = false;
    public $fourStar = false;
    public $threeStar = false;
    public $twoStar = false;
    public $oneStar = false;
    public $quality = false;
    public $price = false;
    public $desc = false;
    public $shipping = false;
    public $packaging = false;
    public $service = false;
    public $topicKeywords = [];
    public $isShowAllReview = false;

    public function mount($arrayStars, $product)
    {
        $this->product = $product;
        $this->arrayStars = $arrayStars;
        $this->sortBy($this->sortField);
    }
    public function updatedSortField($value)
    {
        $this->sortBy($value);
    }
    public function updatedFiveStar($value)
    {
        $this->fiterByStars($value == true ? 5 : 5);
    }
    public function updatedFourStar($value)
    {
        $this->fiterByStars($value == true ? 4 : 4);
    }
    public function updatedThreeStar($value)
    {
        $this->fiterByStars($value == true ? 3 : 3);
    }
    public function updatedTwoStar($value)
    {
        $this->fiterByStars($value == true ? 2 : 2);
    }
    public function updatedOneStar($value)
    {
        $this->fiterByStars($value == true ? 1 : 1);
    }
    public function updatedQuality($topic)
    {
        $this->filterByTopics($topic == true ? 'kualitas barang' : 'kualitas barang');
    }
    public function updatedPrice($topic)
    {
        $this->filterByTopics($topic == true ? 'harga barang' : 'harga barang');
    }
    public function updatedDesc($topic)
    {
        $this->filterByTopics($topic == true ? 'sesuai deskripsi' : 'sesuai deskripsi');
    }
    public function updatedShipping($topic)
    {
        $this->filterByTopics($topic == true ? 'pengiriman' : 'pengiriman');
    }
    public function updatedPackaging($topic)
    {
        $this->filterByTopics($topic == true ? 'kemasan barang' : 'kemasan barang');
    }
    public function updatedService($topic)
    {
        $this->filterByTopics($topic == true ? 'pelayanan penjual' : 'pelayanan penjual');
    }
    public function filterByTopics($topic)
    {
        if (($key = array_search($topic, $this->topicKeywords)) !== false) {
            unset($this->topicKeywords[$key]);
        } else {
            $this->topicKeywords[] = $topic;
        }
    }
    public function fiterByStars($star)
    {
        if (($key = array_search($star, $this->filterByStars)) !== false) {
            unset($this->filterByStars[$key]);
        } else {
            $this->filterByStars[] = $star;
        }
    }
    public function sortBy($params)
    {
        switch ($params) {
            case 'terbaru':
                $this->sortBy = 'created_at';
                $this->sortDirection = 'desc';
                break;
            case 'tertinggi':
                $this->sortBy = 'rating';
                $this->sortDirection = 'desc';
                break;
            case 'terendah':
                $this->sortBy = 'rating';
                $this->sortDirection = 'asc';
                break;
        }
    }
    public function showAllReviews()
    {
        $this->isShowAllReview = true;
    }
    public function render()
    {
        $productAssessmentsQuery = $this->product
            ->productAssessment()
            ->when($this->filterByMedia == true, function ($query) {
                $query->whereHas('attachments');
            })
            ->when(count($this->filterByStars) > 0, function ($query) {
                $query->whereIn('rating', $this->filterByStars);
            })
            ->when(count($this->topicKeywords) > 0, function ($query) {
                $query->whereRaw("MATCH(content) AGAINST(? IN BOOLEAN MODE)", ["+" . implode(' +', $this->topicKeywords)]);
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        $attachmentsQuery = clone $productAssessmentsQuery;

        $attachments = $attachmentsQuery->whereHas('attachments')->with('attachments')->get()->flatMap(function ($assessment) {
            return $assessment->attachments;
        });

        if ($this->isShowAllReview) {
            $productAssessments = $productAssessmentsQuery->get();
        } else {
            $productAssessments = $productAssessmentsQuery->paginate(4);
        }

        return view('livewire.assessment', [
            'productAssessments' => $productAssessments,
            'attachments' => $attachments,
        ]);
    }

}
