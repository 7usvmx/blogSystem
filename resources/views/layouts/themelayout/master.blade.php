<!DOCTYPE html>
<html lang="en">
@include('layouts.themelayout.partial.head')

<body>
  @include("layouts.themelayout.partial.header")

  @yield("content")

  @include("layouts.themelayout.partial.footer")
  @include("layouts.themelayout.partial.scripts")
</body>

</html>