defmodule ReportsGenerator.Parser do
  def parse_file(filename) do
    "reports/#{filename}"
    |> File.stream!()
    |> Stream.map(fn line -> parse_line(line) end)
  end

  #  defp report_acc, do: Enum.into(1..30, %{}, &{Integer.to_string(&1), 0})

  defp parse_line(line) do
    line
    |> String.trim()
    |> String.split(",")
    |> List.update_at(2, &String.to_integer/1)

    # |> List.update_at(0, fn elem -> String.to_integer(elem) end)
  end

  # defp handle_file({:ok, content}), do: content
  # defp handle_file({:error, _reason}), do: "Error while opening file!"
end
