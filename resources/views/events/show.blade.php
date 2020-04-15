@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{$event->title}}</h3>
        <div class="pt-2 pb-4">
            <h4>Short Description</h4>
            <div>
                <?php echo $event->short_desc ?>
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h4>Full Description</h4>
            <div>
                <?php echo $event->full_desc ?>
            </div>
        </div>
        <div class="pt-2 pb-4">
            <h4>Duration</h4>
            <table>
                <thead>
                    <tr>
                        <th>0</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                    </tr>
                        @foreach($event->duration as $row)
                        <tr>
                            @foreach( str_split($row,1) as $checked)
                            <td>
                                <input type="checkbox" disabled <?php echo $checked == 1 ? 'checked' : '' ?> />
                                
                            </td>
                            @endforeach
                        </tr>
                    
                    @endforeach
                </thead>
                
            </table>
        </div>
    <button type="button" class="btn btn-secondary">
        <a href="/event/{{$event->id}}/edit">Edit Event</a>
    </button>
        
</div>
@endsection