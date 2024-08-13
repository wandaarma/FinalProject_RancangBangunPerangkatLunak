<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkspaceModel;

use Illuminate\Http\Request;

class SlashworkController extends Controller
{
    public function slashwork($id)
    {
        $datakelompok = WorkspaceModel::where('id', $id)->get();
        return view('workspace/slashwork', ['data_kelompok' => $datakelompok]);
    }

    public function hasilslash($id, Request $request)
    {
        $datakelompok = WorkspaceModel::where('id', $id)->get();
        $subtask = $request->input('subtask');
        $members = $request->input('members');
        $progress = $request->input('progress');
        $shuffledTasks = $this->shuffleTasks($subtask, count($members));
        foreach ($members as $index => $member) {
            if ($member === null || $member === '') {
                continue;
            }
            $taskIndex = $index;
            $task = $shuffledTasks[$taskIndex];
            if ($task !== null && $task !== '') {
                $progressValue = $progress ? 1 : 0;
                DB::table('hasil_slash')->insert([
                    'member_name' => $member,
                    'slash_subtask' => $task,
                    'progress' => $progressValue,
                ]);
            }
        }
        $hasilAcakan = DB::table('hasil_slash')->whereIn('member_name', $members)->get();
        return view('workspace/hasilslash', ['hasilAcakan' => $hasilAcakan, 'members' => $members, 'data_kelompok' => $datakelompok]);
    }

    private function shuffleTasks($tasks, $memberCount)
    {
        $shuffledTasks = $tasks;
        shuffle($shuffledTasks);
        $tasksPerMember = (int) (count($shuffledTasks) / $memberCount);
        $remainder = count($shuffledTasks) % $memberCount;
        $taskChunks = array_chunk($shuffledTasks, $tasksPerMember);
        $lastChunkIndex = count($taskChunks) - 1;
        for ($i = 0; $i < $remainder; $i++) {
            $lastChunkIndex = ($lastChunkIndex + 1) % $memberCount;
            $taskChunks[$lastChunkIndex][] = array_pop($shuffledTasks);
        }
        $shuffledTasks = array_merge(...$taskChunks);
        return $shuffledTasks;
    }


}
