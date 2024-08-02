<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Cfhens\RuleModel;
use App\Models\Cfhens\SymptomModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Manage extends BaseController
{
    use ResponseTrait;
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger, ) {
        parent::initController($request, $response, $logger);
        $this->view->setData([
            // "user" => TeamSession::user()
        ]);
    }
    public function index(): string
    {
        $this->view->setData([
            "page" => "dashboard",
        ]);
        return $this->view->render("pages/panel/index");
    }
    public function disease(): string
    {
        $this->view->setData([
            "page" => "disease",
        ]);
        return $this->view->render("pages/panel/disease");
    }
    public function symptom(): string
    {
        $this->view->setData([
            "page" => "symptom",
        ]);
        return $this->view->render("pages/panel/symptom");
    }
    public function rule(): string
    {
        $this->view->setData([
            "page" => "rule",
        ]);
        return $this->view->render("pages/panel/rule");
    }
    public function implementasiView(): string
    {
        $this->view->setData([
            "page" => "implement",
        ]);
        return $this->view->render("pages/panel/implement");
    }
    public function implementasi()
    {
        $cfuser = collect([]);
        collect($this->request->getPost())->each(function ($value, $key) use (&$cfuser) {
            if ($value > 0) {
                $cfuser->push($key);
            };
        });

        $symptomps = SymptomModel::whereIn('code', $cfuser->toArray())->get();
        $diseases = collect([]);
        $result = collect([]);
        RuleModel::whereIn("symptom_id", $symptomps->map(function ($value, $key) {
            return $value->id;
        }))->each(function ($value, $key) use (&$diseases) {
            if ($value->effect_type == "disease") {
                if (!in_array($value->effect->id, $diseases->pluck("id")->toArray())) {
                    $diseases->push($value->effect);
                }
            }
        });

        $diseases->each(function ($value, $key) use (&$result, $cfuser) {
            $cfhe = collect([]);
            $value->rules->each(function ($rule, $key) use (&$cfhe, $result, $cfuser) {
                $symptom = SymptomModel::find($rule->symptom_id);
                $cfhe->push((double) (1 * (in_array($symptom->code, $cfuser->toArray()) ? 1 : 0)));
            });

            $cfcombine = 0.0;
            $cfhe->each(function ($value, $key) use (&$cfcombine) {
                if ($key == 0) {
                    $cfcombine += $value;
                    return;
                }

                $cfcombine += $value * (1 - $cfcombine);
            });
            $result->push([
                "penyakit" => $value,
                "cfhe" => $cfhe,
                "cfcombine" => $cfcombine,
            ]);
        });

        $result = $result->sortByDesc("cfcombine")->values();

        return $this->respond([
            "cfuser" => $cfuser,
            "result" => $result,
            "diseases" => $diseases,
        ]);
    }
}
