defmodule NewMix do
  use Application

  def start(_type, _args) do
    :timer.tc(fn -> ReportsGenerator.build("a.csv") end)
  end
end
