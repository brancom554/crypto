<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalMeta extends Model
{

    protected $table = 'global_metas';

    protected $fillable = [
        'name',
    ];

    public static function get_value($name, $pid=null, $output=null)
    {
        if (!empty($pid)) {
            $result = self::where(['name' => $name, 'pid' => $pid])->first();
        } else {
            $result = self::where(['name' => $name])->first();
        }

        $return = (!empty($output) && isset($result->$output)) ? $result->$output : $result;

        return $return;
    }

    public static function save_meta($name, $value = null, $pid = null, $extra = null)
    {
        if ($pid != null) {
            $meta = self::where(['name' => $name, 'pid' => $pid])->first();
        } else {
            $meta = self::where(['name' => $name])->first();
        }

        if ($meta == null) {
            $meta = new self();
            $meta->name = $name;
            if ($pid != null) {
                $meta->pid = $pid;
            }
        }

        if ($value != null) {
            $meta->value = $value;
            if ($extra != null) {
                $meta->extra = $extra;
            }
            $meta->save();
        }

        return $meta;
    }


    public static function has_access($type=null, $uid=null)
    {
        $user_id = ($uid) ? $uid : auth()->id();
        if (in_array($user_id, self::get_super_admins())) {
            return true;
        }

        $get_access = self::where(['pid' => $user_id, 'name' => 'manage_access'])->first();
        if(!empty($get_access)) {
            $access = json_decode($get_access->extra, true);
            return self::check_access($access, $type);
        } else {
            $access = array_values(json_decode(gws('manage_access_default', json_encode(['level' => ['none']])), true));
            return self::check_access($access[0], $type);
        }
        return [];
    }

    public static function check_access($data, $type=null)
    {
        if(in_array('as_super_admin', $data)) {
            return true;
        } elseif(!empty($type)) {
            return (in_array($type, $data)) ?  [$type] : [];
        }
        return array_unique($data);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'pid', 'id');
    }

    public function data()
    {
        return (is_json($this->value) ? json_decode($this->value) : $this->value);
    }
}
