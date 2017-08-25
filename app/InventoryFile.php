<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InventoryFile
 *
 * @property int $id
 * @property string|null $name
 * @property int $inventory_id
 * @property string $type
 * @property string $url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Inventory $inventory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryFile whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryFile whereUrl($value)
 * @mixin \Eloquent
 */
class InventoryFile extends Model
{
    protected $fillable = ['name', 'type', 'url'];

    protected function getDateFormat()
    {
        return config('app.date_format');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function isImage()
    {
        return str_is('image*', $this->type);
    }

    public function isPDF()
    {
        return str_is('*pdf', $this->type);
    }

    public function isWord()
    {
        return str_is('*.doc*', $this->name);
    }

    public function isExcel()
    {
        return str_is('*.xls*', $this->name);
    }

    public function isCSV()
    {
        return str_is('*.csv', $this->name);
    }

    public function isPPT()
    {
        return str_is('*.ppt*', $this->name);
    }

    public function isTXT()
    {
        return str_is('*.txt', $this->name);
    }

    public function isRAR()
    {
        return str_is('*rar*', $this->type);
    }

    public function isZIP()
    {
        return str_is('*zip*', $this->type);
    }

    public function getCategory()
    {
        return $this->isImage() ? 'images' : 'documents';
    }

    public function getUrlFileImage()
    {
        if ($this->isImage()) return $this->url;
        else if ($this->isPDF()) return 'img/pdf.jpg';
        else if ($this->isWord()) return 'img/doc.jpg';
        else if ($this->isExcel()) return 'img/xls.jpg';
        else if ($this->isPPT()) return 'img/ppt.jpg';
        else if ($this->isTXT()) return 'img/txt.jpg';
        else if ($this->isCSV()) return 'img/csv.jpg';
        else if ($this->isRAR()) return 'img/rar.jpg';
        else if ($this->isZIP()) return 'img/zip.jpg';
        return 'img/file.jpg';
    }
}
