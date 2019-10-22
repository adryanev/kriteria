<?php
/**
 * Project: kriteria.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 10/22/2019
 * Time: 5:29 PM
 */

namespace akreditasi\models\kriteria9\lk\prodi;



use common\models\kriteria9\lk\institusi\K9LkInstitusiKriteria3;

class K9LkInstitusiNarasiKriteria3Form extends K9LkInstitusiKriteria3
{

    public function beforeSave($insert)
    {
        $this->updateProgress();
        $this->lkInstitusi->updateProgress();
        $this->lkInstitusi->akreditasiInstitusi->updateProgress();
        return parent::beforeSave($insert);
    }

    public function updateProgress()
    {
        $count = 0;

        $exclude = ['id', 'id_lk_institusi', 'progress', 'created_at', 'updated_at'];

        $filters = array_filter($this->attributes, function ($attribute) use ($exclude) {
            return in_array($attribute, $exclude) === false;
        }, ARRAY_FILTER_USE_KEY);

        $total = sizeof($filters);

        foreach ($filters as $attribute) {
            if ($attribute !== null) {
                $count += 1;
            }
        }

        $progress = round(($count / $total) * 100, 2);

        $this->progress = $progress;

        return true;
    }
}